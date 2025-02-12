@extends('adminlte::page')

@section('content')
    <p>
        Welcome to this beautiful admin panel.</p>
    <p>@auth
        <p>Hello, {{ Auth::user()->name }}!</p>
    @endauth
    </p>
@endsection
