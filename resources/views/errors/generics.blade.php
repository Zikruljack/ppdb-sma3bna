@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1 class="text-danger">{{ $code }}</h1>
        <h3>{{ $message }}</h3>
        <p>Silakan kembali ke halaman utama.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
@endsection
