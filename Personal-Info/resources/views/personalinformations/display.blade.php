@extends('layout')
@section('content')
    <div class="content">
        <h4> Name : {{ $personalinformation->name }} </h4>
        <h4> Address : {{ $personalinformation->address }}</h4>
        <h4> Birthday : {{ $personalinformation->birthday }}</h4>
        <h4> Phone Number : {{ $personalinformation->phone_number }}</h4>
        <h4> Email Address : {{ $personalinformation->email }}</h4>
        
        <p> <a href="/personalinformations/{{ $personalinformation->id }}/edit">Edit</a> </p>
    </div>
@endsection