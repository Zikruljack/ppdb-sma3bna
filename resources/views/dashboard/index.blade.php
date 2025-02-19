@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalPendaftar }}</h3>
                        <p>Total Pendaftar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalLengkap }}</h3>
                        <p>Pendaftar Lengkap</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $totalLulus }}</h3>
                        <p>Total yang Lulus Pemberkasan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalPendaftarPrestasi }}</h3>
                        <p>Total Peserta Pendaftaran Prestasi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $totalPendaftarKepemimpinan }}</h3>
                        <p>Total Peserta Pendaftaran Kepemimpinan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-crown"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $totalSiswaDenganNilai }}</h3>
                        <p>Total Peserta Yang Sudah Test Semuanya</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
