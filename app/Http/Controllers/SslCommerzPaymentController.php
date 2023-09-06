<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Room;
use App\Models\Booking;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\BookingDetails;
use RealRashid\SweetAlert\Facades\Alert;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Validator;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request, $id)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        // dd($id);

        $room = Room::find($id);
        // dd($room);
        $post_data = array();
        $post_data['total_amount'] = $room->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->contact;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        $request->validate([
            "check_in" => "date|after_or_equal:now",
            "check_out" => "date|after:check_in",
        ]);

        $room = Room::find($id);
        $fromDate = $request->check_in;
        $toDate = $request->check_out;

        //

        $roomAvailability = BookingDetails::where('room_id', $room->id)
            ->whereBetween('check_in_date', [$fromDate, $toDate])
            ->pluck('check_in_date');

        $period = CarbonPeriod::create($fromDate, $toDate);


        $totalDays = count($period);
        $booking = null;
        // Iterate over the period
        foreach ($period as $key => $date) {
            foreach ($roomAvailability as $availableRoom) {
                // $dateToFormateYHD =
                if ($availableRoom = date('Y-m-d', strtotime($date))) {
                    Alert::error('Opps !!', 'Room Not Available on this day');
                    return redirect()->route('website.rooms');
                }
            }

            if ($key == 0) {

                $booking = Booking::create([
                    'user_id' => auth()->user()->id,
                    'room_id' => $room->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'contact' => $request->contact,
                    "days" => $totalDays,
                    "status" => "Payment Pending",
                    "tran_id" => $post_data['tran_id'],
                    'total_amount' => $post_data['total_amount']

                ]);
            }

            BookingDetails::create([
                'booking_id' => $booking->id,
                'user_id' => auth()->user()->id,
                'room_id' => $room->id,
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'contact' => $request->contact,
                'check_in_date' => $date,

            ]);

        }

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }


    public function success(Request $request)
    {
        $trans = "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('bookings')
            ->where('tran_id', $tran_id)
            ->select('tran_id', 'status', 'total_amount')->first();

        if ($order_detials->status == 'Payment Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);
            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = Booking::where('tran_id', $tran_id)
                    ->update(['status' => 'Processing']);
                $order=Booking::where('tran_id', $tran_id)->first();
                $message = "Your Payment is Completed Successfully";
                return view('frontend.pages.paymentSuccess', compact('order', 'trans', 'message'));
            }
        }
        else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $order=Booking::where('tran_id', $tran_id)->first();
            $message = "Your Payment Already Completed";
            return view('frontend.pages.paymentSuccess', compact('order', 'trans', 'message'));
        }
        else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public
    function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('bookings')
            ->where('tran_id', $tran_id)
            ->select('tran_id', 'status', 'amount')->first();

        if ($order_detials->status == 'Payment Pending') {
            $update_product = DB::table('bookings')
                ->where('tran_id', $tran_id)
                ->update(['status' => 'Payment Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public
    function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('bookings')
            ->where('tran_id', $tran_id)
            ->select('tran_id', 'status', 'amount')->first();

        if ($order_detials->status == 'Payment Pending') {
            $update_product = DB::table('bookings')
                ->where('tran_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public
    function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('bookings')
                ->where('tran_id', $tran_id)
                ->select('tran_id', 'status', 'amount')->first();

            if ($order_details->status == 'Payment Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('bookings')
                        ->where('tran_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
