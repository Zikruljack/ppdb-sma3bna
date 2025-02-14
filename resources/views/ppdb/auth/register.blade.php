@extends('layouts.site.site')

@section('title', 'Daftar SPMB')

@section('hero')
    <section class="wrapper bg-dark text-white">
        <div class="container pt-18 pt-md-20 pb-21 pb-md-21 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-1 text-white mb-3">Sign Up</h1>
                    <nav class="d-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb text-white">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar SPMB</li>
                        </ol>
                    </nav>
                    <!-- /nav -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection


@section('content')
    <section class="wrapper bg-light">
        <div class="container pb-14 pb-md-16">
            <div class="row">
                <div class="col mt-n19">
                    <div class="card shadow-lg">
                        <div class="row gx-0 text-center">
                            <div class="col-lg-6 image-wrapper bg-image bg-cover rounded-top rounded-lg-start d-none d-md-block"
                                data-image-src="{{ asset('assets/img/i22.png') }}">
                            </div>
                            <!--/column -->
                            <div class="col-lg-6">
                                <div class="p-10 p-md-11 p-lg-13">
                                    <h2 class="mb-3 text-start">Daftar SPMB</h2>
                                    <p class="lead mb-6 text-start">Pendaftaran akun tidak sampai semenit.</p>
                                    <form class="text-start mb-3" method="post" action="{{ route('register.attempt') }}">
                                        @csrf
                                        <div class="form-floating mb-4">
                                            <input name="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" placeholder="Name"
                                                id="loginName">
                                            <label for="loginName">Nama Lengkap</label>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input name="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" id="loginEmail">
                                            <label for="loginEmail">Email</label>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating password-field mb-4">
                                            <input name="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" id="loginPassword">
                                            <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                            <label for="loginPassword">Password</label>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-floating password-field mb-4">
                                            <input name="password_confirmation" type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror""
                                                placeholder="Confirm Password" id="loginPasswordConfirm">
                                            <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                            <label for="loginPasswordConfirm">Konfirmasi Password</label>

                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        <div class="form-select-wrapper mb-4">
                                            <select class="form-control  @error('password') is-invalid @enderror "
                                                id="jalur_pendaftaran" name="jalur_pendaftaran">
                                                <option selected value="">Pilih</option>
                                                <option value="prestasi">Prestasi</option>
                                                <option value="kepemimpinan">Kepemimpinan</option>
                                            </select>

                                            @error('jalur_pendaftaran')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary rounded-pill btn-login w-100 mb-2">Daftar</button>
                                    </form>
                                    <!-- /form -->
                                    <p class="mb-0">Sudah Mempunyai akun? <a href="{{ route('login') }}"
                                            class="hover">Masuk</a></p>

                                    <!--/.social -->
                                </div>
                                <!--/div -->
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
@endsection
