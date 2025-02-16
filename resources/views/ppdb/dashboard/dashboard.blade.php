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
                    <div class="alert alert-info">
                        @if ($ppdbUser->status == 'Valid')
                            <h5 class="alert-heading">Informasi</h5>
                            <p>
                                Berkas Anda telah divalidasi oleh panitia. Silahkan menjumpai panitia di sekolah.
                            </p>
                        @elseif($ppdbUser->status == 'Final')
                            <h5 class="alert-heading">Informasi</h5>
                            <p>
                                Mohon ditunggu, data Anda sedang divalidasi oleh panitia.
                            </p>
                        @elseif($ppdbUser->status == 'Tidak Valid')
                            <h5 class="alert-heading">Informasi</h5>
                            <p>
                                Berkas Anda tidak divalidasi oleh panitia. Silahkan menjumpai panitia di sekolah.
                            </p>
                        @elseif($ppdbUser->status == 'Pendaftar')
                            <h5 class="alert-heading">Informasi</h5>
                            <p>
                                Lengkapi data diri anda untuk melanjutkan proses pendaftaran.
                            </p>
                            <a href="{{ route('ppdb.pendaftaran') }}" class="btn btn-primary">Lengkapi Data
                                Diri</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
