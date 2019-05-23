@extends('layout')

@section('content')
    <h1 class="title">Edit Personal Info</h1>

    <form method="POST" action="/personalinformations/{{  $personalinformation->id }}" style="magrin-bottom: lem;">
        @method('PATCH')
        @csrf
        <div class="field">
            <label class="label" for="name">Name</label>
            <div class="control">
            <input type="text" class="input" name="name" placeholder="Name" value="{{ $personalinformation->name }}" required>
            </div>
        </div>
        <div class="field">
            <label class="label" for="address">Address</label>
            <div class="control">
            <input type="text" class="input" name="address" placeholder="Address" value="{{ $personalinformation->address }}" required>
            </div>
        </div>
        <div class="field">
            <label class="label" for="birthday">Birth Date</label>
            <div class="control">
            <input type="text" class="input" name="birthday" placeholder="Birth Date" value="{{ $personalinformation->birthday }}" required>
            </div>
        </div>
        <div class="field">
            <label class="label" for="phone_number">Phone Number</label>
            <div class="control">
            <input type="text" class="input" name="phone_number" placeholder="Phone Number" value="{{ $personalinformation->phone_number }}" required>
            </div>
        </div>
        <div class="field">
            <label class="label" for="email">Email Address</label>
            <div class="control">
            <input type="text" class="input" name="email" placeholder="Email Address" value="{{ $personalinformation->email }}" required>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link" style="width: 15%; padding-bottom: 25px;">Update Information</button>
                &nbsp;
            </div>
        </div>
    </form>

    <form method="POST" action="/personalinformations/{{ $personalinformation->id }}">
            @method('DELETE')
            @csrf
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-link" style="width: 15%;">Delete Information</button>
                </div>
            </div>
            @include('errors')

    </form>

@endsection