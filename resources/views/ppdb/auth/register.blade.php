@extends('layouts.site.site')

@section('hero')
    <section class="wrapper bg-dark text-white">
        <div class="container pt-18 pt-md-20 pb-21 pb-md-21 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-1 text-white mb-3">Sign Up</h1>
                    <nav class="d-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb text-white">
                            <li class="breadcrumb-item"><a href="{{ route('landing.page') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar PPDB</li>
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
                                    <h2 class="mb-3 text-start">Daftar PPDB</h2>
                                    <p class="lead mb-6 text-start">Pendaftaran akun tidak sampai semenit.</p>
                                    <form class="text-start mb-3" method="post" action="{{ route('register.attempt') }}">
                                        @csrf
                                        <div class="form-floating mb-4">
                                            <input type="text" class="form-control" placeholder="Name" id="loginName">
                                            <label for="loginName">Nama Lengkap</label>
                                        </div>
                                        <div class="form-floating mb-4">
                                            <input type="email" class="form-control" placeholder="Email" id="loginEmail">
                                            <label for="loginEmail">Email</label>
                                        </div>
                                        <div class="form-floating password-field mb-4">
                                            <input type="password" class="form-control" placeholder="Password"
                                                id="loginPassword">
                                            <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                            <label for="loginPassword">Password</label>
                                        </div>
                                        <div class="form-floating password-field mb-4">
                                            <input type="password" class="form-control" placeholder="Confirm Password"
                                                id="loginPasswordConfirm">
                                            <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                            <label for="loginPasswordConfirm">Konfirmasi Password</label>
                                        </div>
                                        <div class="form-select-wrapper mb-4">
                                            <select class="form-control" id="jalur_pendaftaran" name="jalur_pendaftaran">
                                                <option selected value="">Pilih</option>
                                                <option value="Prestasi">Prestasi</option>
                                                <option value="Kepemimpinan">Kepemimpinan</option>
                                            </select>
                                        </div>
                                        <a class="btn btn-primary rounded-pill btn-login w-100 mb-2">Daftar</a>
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
