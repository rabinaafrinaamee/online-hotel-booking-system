@extends('master')

@section('content')

    <h1>
        Welcome to {{ config('app.name')}}
    </h1>
    <img width="100%"
         src="{{ asset('/img/rt001.jpg') }}">

@endsection
