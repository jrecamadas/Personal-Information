<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body> 
        <h1>List of Personal Information</h1>
        <ul>
            @foreach($informations as $personalinformation)
                <li>
                    <a href="/personalinformations/{{ $personalinformation->id }}">
                        {{ $personalinformation->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </body>
    <form action="/personalinformations/create">
        @csrf
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Add New Personal Info</button>
            </div>
        </div>
    </form>
</html>
