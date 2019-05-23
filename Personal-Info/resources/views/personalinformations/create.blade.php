@extends('layout')
@section('content')
    <html>
        <head>
            <title></title>
        </head>
        <body> 
            <h1 class="title">Create New Personal Info</h1>
            <form method="POST" action="/personalinformations" style="magrin-bottom: lem;">
                @csrf
                <div class="field">
                    <label class="label" for="name">Name</label>
                        <div class="control">
                            <input type="text" class="input" name="name" placeholder="Name" value="{{old('name')}}">
                        </div>
                </div>
                <div class="field">
                        <label class="label" for="address">Address</label>
                        <div class="control">
                            <textarea name="address" class="input" placeholder="Address"> {{old('address')}} </textarea>
                        </div>
                </div>
                <div class="field">
                    <label class="label" for="birthday">Birthdate</label>
                    <div class="control">
                        <input type="datetime" class="input" name="birthday" placeholder="Birthdate" value="{{old('birthday')}}">
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="phone_number">Phone Number</label>
                    <div class="control">
                        <textarea name="phone_number" class="input" placeholder="Phone Number"> {{old('phone_number')}} </textarea>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="email">Email Address</label>
                    <div class="control">
                        <textarea name="email" class="input" placeholder="Email Address"> {{old('email')}} </textarea>
                    </div>
                </div>
                <div>
                    <button type="submit" class="button is-link" style="width: 15%">Add</button> 
                </div>
                @include('errors')
            </form>
        </body>
    </html>
@endsection