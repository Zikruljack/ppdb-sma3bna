@extends('layouts.site.site')

@section('content')
    <div class="card">
        <div class="card-header">
            Formulir Pendaftaran
        </div>
        <div class="card-body">
            <form action="/submit-ppdb" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon:</label>
                    <input type="text" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Alamat:</label>
                    <textarea id="address" name="address" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Daftar</button>
            </form>
        </div>
    </div>
@endsection
