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
                    <div class="alert
                        @if ($ppdbUser->status == 'Valid') alert-success
                        @elseif($ppdbUser->status == 'Final')
                            alert-warning
                        @elseif($ppdbUser->status == 'Perbaikan')
                            alert-danger
                        @elseif($ppdbUser->status == 'Tidak Valid')
                            alert-danger
                        @elseif($ppdbUser->status == 'Pendaftar')
                            alert-info @endif
                        {{ $ppdbUser->status == 'Pendaftar' ? 'alert-dismissible fade show' : '' }}"
                        role="alert">

                        <h5 class="alert-heading">
                            <i class="fas fa-info-circle"></i> Informasi
                        </h5>

                        @if ($ppdbUser->status == 'Valid')
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success fa-2x mr-3"></i>
                                <p class="mb-0">Berkas Anda telah divalidasi oleh panitia. Silahkan menjumpai panitia di
                                    sekolah.</p>
                            </div>
                        @elseif($ppdbUser->status == 'Final')
                            <div class="d-flex align-items-center">
                                <i class="fas fa-hourglass-half text-warning fa-2x mr-3"></i>
                                <p class="mb-0">Mohon ditunggu, data Anda sedang divalidasi oleh panitia.</p>
                            </div>
                        @elseif($ppdbUser->status == 'Perbaikan')
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle text-danger fa-2x mr-3"></i>
                                <p class="mb-0">Berkas Anda perlu diperbaiki.</p>
                                <a href="{{ route('ppdb.pendaftaran') }}" class="btn btn-primary mt-2">
                                    <i class="fas fa-edit"></i> Lengkapi Data Diri
                                </a>
                            </div>
                        @elseif($ppdbUser->status == 'Tidak Valid')
                            <div class="d-flex align-items-center">
                                <i class="fas fa-times-circle text-danger fa-2x mr-3"></i>
                                <p class="mb-0">Berkas Anda tidak divalidasi oleh panitia. Silahkan menjumpai panitia di
                                    sekolah.</p>
                            </div>
                        @elseif($ppdbUser->status == 'Pendaftar')
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-info fa-2x mr-3"></i>
                                <p class="mb-0">Lengkapi data diri anda untuk melanjutkan proses pendaftaran.</p>
                            </div>
                            <a href="{{ route('ppdb.pendaftaran') }}" class="btn btn-primary mt-2">
                                <i class="fas fa-edit"></i> Lengkapi Data Diri
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
