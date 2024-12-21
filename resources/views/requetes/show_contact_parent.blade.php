<!-- resources/views/requetes/show_contact_parent.blade.php -->
@extends("navbarmodel.navbar2")

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Contact Parent</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Contact Parent</h1>
        @if(isset($contactparent))
            <p>Contact du parent : {{ $contactparent }}</p>
        @else
            <p>{{ $message }}</p>
        @endif
    </div>
@endsection
