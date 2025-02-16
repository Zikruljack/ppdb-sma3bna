@extends('adminlte::page')

@section('title', 'Dashboard Siswa')

@section('content_header')
    <h1>Dashboard Siswa</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Status Pendaftaran</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Data Diri
                            <span
                                class="badge badge-{{ $dataDiriLengkap ? 'success' : 'danger' }}">{{ $dataDiriLengkap ? 'Lengkap' : 'Belum Lengkap' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Nilai Rapor
                            <span
                                class="badge badge-{{ $nilaiRaporLengkap ? 'success' : 'danger' }}">{{ $nilaiRaporLengkap ? 'Lengkap' : 'Belum Lengkap' }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Berkas
                            <span
                                class="badge badge-{{ $berkasLengkap ? 'success' : 'danger' }}">{{ $berkasLengkap ? 'Lengkap' : 'Belum Lengkap' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if ($dataDiriLengkap && $nilaiRaporLengkap && $berkasLengkap)
        <div class="alert alert-info">
            <strong>Informasi:</strong> Data Anda sudah lengkap. Mohon bawa berkas fisik ke sekolah dan tunggu validasi oleh
            panitia.
        </div>
    @endif

    @if ($sudahValidasi)
        <div class="text-center">
            <a href="{{ route('download.kartu') }}" class="btn btn-success btn-lg">
                <i class="fas fa-download"></i> Download Kartu Ujian
            </a>
        </div>
    @endif
@endsection
