@extends('layouts.site.site')

@section('title', 'Masuk SPMB')

@section('hero')
    <section class="wrapper bg-dark text-white">
        <div class="container pt-18 pt-md-20 pb-21 pb-md-21 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-1 text-white mb-3">Masuk</h1>
                    <nav class="d-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb text-white">
                            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Masuk SPMB</li>
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
                                data-image-src="./assets/img/photos/tm3.jpg">
                            </div>
                            <!--/column -->
                            <div class="col-lg-6">
                                <div class="p-10 p-md-11 p-lg-13">
                                    <h2 class="mb-3 text-start">Selamat Datang</h2>
                                    <p class="lead mb-6 text-start">Masukkan email dan password untuk masuk</p>
                                    <form class="text-start mb-3" action="{{ route('login.attempt') }}" method="POST">
                                        @csrf
                                        <div class="form-floating mb-4">
                                            <input type="email" name="email" class="form-control" placeholder="Email"
                                                id="loginEmail">
                                            <label for="loginEmail">Email</label>
                                        </div>
                                        <div class="form-floating password-field mb-4">
                                            <input type="password" name="password" class="form-control"
                                                placeholder="Password" id="loginPassword">
                                            <span class="password-toggle"><i class="uil uil-eye"></i></span>
                                            <label for="loginPassword">Password</label>
                                        </div>
                                        <button type="submit"
                                            class="btn btn-primary rounded-pill btn-login w-100 mb-2">Masuk</button>
                                    </form>
                                    <!-- /form -->
                                    <p class="mb-1"><a href="#" class="hover">Lupa Password?</a></p>
                                    <p class="mb-0">Tidak punya akun? <a href="{{ route('register.ppdb') }}"
                                            class="hover">Daftar</a></p>
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
