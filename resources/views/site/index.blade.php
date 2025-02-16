@extends('layouts.site.site')

@section('title', 'SMAN 3 Banda Aceh')

@section('hero')
    <section class="wrapper bg-gradient-primary">
        <div class="container pt-10 pt-md-14 pb-8 text-center">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-lg-7">
                    <figure><img class="w-auto" src="{{ asset('assets/img/i22.png') }}"
                            srcset="{{ asset('assets/img/i22@2x.png') }} 2x" alt="" /></figure>
                </div>
                <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-5 text-center text-lg-start">
                    <h1 class="display-1 mb-5 mx-md-n5 mx-lg-0">SEKOLAH SMA Negeri 3 Banda Aceh</h1>
                    <p class="lead fs-lg mb-7">Sistem Penerimaan Murid Baru akan segera dibuka, silahkan klik tombol dibawah
                    </p>
                    <span><a href="/ppdb" class="btn btn-primary rounded-pill me-2">SPMB</a></span>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <section class="wrapper bg-grey">
        <div class="container py-14 py-md-16">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-lg-7 order-lg-2">
                    <figure><img class="w-auto" src="{{ asset('assets/img/logo_smantig.png') }}"
                            alt="Logo SMA Negeri 3 Banda Aceh" /></figure>
                </div>
                <div class="col-lg-5">
                    <h2 class="fs-15 text-uppercase text-line text-primary mb-3">Tentang Kami</h2>
                    <h3 class="display-5 mb-7">SMA Negeri 3 Banda Aceh, Sekolah Berprestasi dengan Lingkungan Edukatif</h3>
                    <p>SMA Negeri 3 Banda Aceh adalah salah satu sekolah unggulan di Banda Aceh yang dikenal dengan prestasi
                        akademik dan non-akademik. Sekolah ini menyediakan lingkungan belajar yang nyaman dan fasilitas
                        lengkap untuk mendukung proses pendidikan.</p>
                    <div class="accordion accordion-wrapper" id="accordionExample">
                        <div class="card plain accordion-item">
                            <div class="card-header" id="headingOne">
                                <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                    aria-expanded="true" aria-controls="collapseOne"> Fasilitas Sekolah </button>
                            </div>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    <ul>
                                        <li>Laboratorium IPA, Komputer, dan Bahasa</li>
                                        <li>Perpustakaan dengan koleksi buku yang lengkap</li>
                                        <li>Ruang kelas nyaman dengan proyektor</li>
                                        <li>Lapangan olahraga dan fasilitas ekstrakurikuler</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card plain accordion-item">
                            <div class="card-header" id="headingTwo">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo"> Prestasi Sekolah </button>
                            </div>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    <p>SMA Negeri 3 Banda Aceh telah meraih berbagai prestasi dalam bidang akademik,
                                        olahraga, dan seni. Beberapa di antaranya:</p>
                                    <ul>
                                        <li>Juara Olimpiade Sains Nasional</li>
                                        <li>Juara Debat Bahasa Inggris tingkat provinsi</li>
                                        <li>Juara 1 Kejuaraan Futsal antar SMA se-Aceh</li>
                                        <li>Pemenang Lomba Karya Ilmiah Remaja (LKIR)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card plain accordion-item">
                            <div class="card-header" id="headingThree">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                    aria-expanded="false" aria-controls="collapseThree"> Ekstrakurikuler </button>
                            </div>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    <p>Sekolah ini memiliki berbagai kegiatan ekstrakurikuler yang dapat mengembangkan bakat
                                        siswa, antara lain:</p>
                                    <ul>
                                        <li>OSIS dan Kepemimpinan</li>
                                        <li>Pramuka</li>
                                        <li>Klub Sains dan Teknologi</li>
                                        <li>Paduan Suara</li>
                                        <li>Basket, Sepak Bola, dan Bulu Tangkis</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
