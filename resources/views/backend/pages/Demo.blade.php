@extends("master")

@section('content')
<form action="{{route('demo.store')}}" method="POST">
    @csrf

  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" name="name" class="form-control" id="" required aria-describedby="emailHelp" placeholder="Enter Name">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Number</label>
    <input type="number" name="number" class="form-control" id=""required aria-describedby="emailHelp" placeholder="Enter Number">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" name="address" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter Address">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Amount</label>
    <input type="number" name="amount" class="form-control" id=""required aria-describedby="emailHelp" placeholder="Enter Amount">
  </div>



  <button type="submit" class="btn btn-primary">Submit</button>


</form>
@endsection