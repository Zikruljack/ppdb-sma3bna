@extends('layouts.site.site')

@section('title', 'SPMB')

@section('hero')
    <section class="wrapper image-wrapper bg-image bg-overlay text-white"
        data-image-src="{{ asset('assets/img/front-sma3-bna.jpg') }}">
        <div class="container pt-19 pt-md-21 pb-18 pb-md-20 text-center">
            <div class="row">
                <div class="col-md-10 col-lg-8 col-xl-7 col-xxl-6 mx-auto">
                    <h1 class="display-1 text-white mb-3">SPMB</h1>
                    <p class="lead fs-lg px-md-3 px-lg-7 px-xl-9 px-xxl-10">Selamat Datang di Sistem
                        Penerimaan Murid Baru
                    </p>
                    <p class="lead fs-lg px-md-3 px-lg-7 px-xl-9 px-xxl-10">SMA Negeri 3 Banda Aceh</p>
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
        <div class="container pt-14 pb-12 pt-md-16 pb-md-14">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
                <div class="col-lg-7 order-lg-2">
                    <div class="row gx-md-5 gy-5">
                        <div class="col-md-5 offset-md-1 align-self-end">
                            <div class="card bg-pale-yellow">
                                <div class="card-body">
                                    <img src="{{ asset('assets/icons/lineal/award.svg') }}"
                                        class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" />
                                    <h4>Jalur Prestasi & Kepemimpinan</h4>
                                    <p class="mb-0">17 Februari 2025 - 27 Februari 2025</p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!--/column -->
                        <div class="col-md-6 align-self-end">
                            <div class="card bg-pale-red">
                                <div class="card-body">
                                    <img src="{{ asset('assets/icons/solid/globe-2.svg') }}"
                                        class="svg-inject icon-svg icon-svg-md text-red mb-3" alt="" />
                                    <h4>Jalur Domisili</h4>
                                    <p class="mb-0">Segera diumumkan</p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!--/column -->
                        <div class="col-md-5">
                            <div class="card bg-pale-leaf">
                                <div class="card-body">
                                    <img src="{{ asset('assets/icons/lineal/loyalty.svg') }}"
                                        class="svg-inject icon-svg icon-svg-md text-leaf mb-3" alt="" />
                                    <h4>Jalur Afirmasi</h4>
                                    <p class="mb-0">Segera diumumkan</p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.card -->
                        </div>
                        <!--/column -->
                        <div class="col-md-5">
                            <div class="card bg-pale-purple">
                                <div class="card-body">
                                    <img src="{{ asset('assets/icons/solid/discussion.svg') }}"
                                        class="svg-inject icon-svg icon-svg-md text-purple mb-3" alt="" />
                                    <h4>Jalur Pindah Tugas Orang Tua</h4>
                                    <p class="mb-0">Segera diumumkan</p>
                                </div>
                                <!--/.card-body -->
                            </div>
                            <!--/.card -->
                        </div>
                    </div>
                    <!--/.row -->
                </div>
                <!--/column -->
                <div class="col-lg-5">
                    <h2 class="fs-15 text-uppercase text-primary mb-3">Pendaftaran SPMB</h2>
                    <h3 class="display-4 mb-5">Jalur Pendaftaran SPMB SMA NEGERI 3 BANDA ACEH</h3>
                    <p>Pendaftaran SPMB SMA NEGERI 3 BANDA ACEH dibuka mulai tanggal 17 Februari 2025.
                        Terdapat beberapa jalur pendaftaran yang dapat dipilih:</p>
                    <ul>
                        <li><strong>Jalur Prestasi & Kepemimpinan:</strong> 17 Februari 2025 - 27 Februari 2025</li>
                        <li><strong>Jalur Domisili:</strong> Segara diumumkan</li>
                        <li><strong>Jalur Afirmasi:</strong> Segara diumumkan</li>
                        <li><strong>Jalur Pindah Tugas Orang Tua:</strong> Segara diumumkan</li>
                    </ul>
                    <a href="{{ asset('assets/data/JUKNIS_SPMB_PRESTASI_2025.pdf') }}"
                        class="btn btn-navy rounded-pill mt-3" download>Lihat Selengkapnya</a>
                </div>
                <!--/column -->
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </section>

    <section id="pengumumanSection" class="wrapper bg-soft-orange angled upper-end lower-end">
        <div class="container py-14 py-md-16">
            <div class="row gx-lg-8 gx-xl-12 gy-10">
                <div class="col-lg-6 mb-0">
                    <h2 class="fs-15 text-uppercase text-primary mb-3">Pengumuman</h2>
                    <h3 class="display-5 mb-4">Tahap Selanjutnya Seleksi SPMB Jalur Prestasi dan Kepemimpinan</h3>
                    <p class="lead mb-6">Selamat kepada calon siswa yang telah lolos tahap pertama! Pastikan Anda tidak
                        melewatkan tahap seleksi berikutnya.</p>
                    <p class="lead mb-6">Cek nomor peserta Anda dalam daftar resmi yang telah diumumkan.</p>
                    <p class="lead mb-6"><strong>Unduh file PDF di bawah ini untuk melihat daftar nomor peserta yang wajib
                            mengikuti seleksi tahap selanjutnya dan ruangan berapa peserta harus datang.</strong></p>
                    <a href="{{ asset('assets/data/Kemampuan_Literasi_Bahasa_Inggris_dan_Keagamaan.pdf') }}"
                        class="btn btn-navy rounded-pill mt-3">Lihat Selengkapnya</a>
                </div>

                <div class="col-lg-6">
                    <div id="accordion-3" class="accordion-wrapper">
                        <div class="card accordion-item">
                            <div class="card-header" id="accordion-heading-3-1">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-1"
                                    aria-expanded="false" aria-controls="accordion-collapse-3-1">
                                    Jadwal Wawancara dan Tes Literasi dan Baca Al-Qur’an
                                </button>
                            </div>
                            <div id="accordion-collapse-3-1" class="collapse" aria-labelledby="accordion-heading-3-1"
                                data-bs-target="#accordion-3">
                                <div class="card-body">
                                    <p><strong>Senin, 24 Februari 2025</strong></p>
                                    <ul>
                                        <li>Pukul 14.00 WIB s.d 17.00 WIB</li>
                                        <li>Memakai seragam SMP/MTs sekolah asal</li>
                                        <li>Membawa kartu peserta SPMB</li>
                                    </ul>
                                    <p><strong>Selasa, 25 Februari 2025</strong></p>
                                    <ul>
                                        <li>Pukul 14.00 WIB s.d 17.00 WIB</li>
                                        <li>Memakai seragam SMP/MTs sekolah asal</li>
                                        <li>Membawa kartu peserta SPMB</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <div class="card-header" id="accordion-heading-3-2">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-2"
                                    aria-expanded="false" aria-controls="accordion-collapse-3-2">
                                    Kriteria Penilaian
                                </button>
                            </div>
                            <div id="accordion-collapse-3-2" class="collapse" aria-labelledby="accordion-heading-3-2"
                                data-bs-target="#accordion-3">
                                <div class="card-body">
                                    <p>Seleksi Jalur Prestasi tidak lagi menggunakan tes tulis, melainkan berdasarkan:</p>
                                    <ul>
                                        <li>Rata-rata nilai rapor 6 pelajaran semester 3, 4, dan 5</li>
                                        <li>Bobot atau poin dari sertifikat prestasi</li>
                                        <li>Kemampuan Literasi Bahasa Inggris dan Membaca Al-Qur’an</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card accordion-item">
                            <div class="card-header" id="accordion-heading-3-3">
                                <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-3-3"
                                    aria-expanded="false" aria-controls="accordion-collapse-3-3">
                                    Lokasi dan Tata Tertib
                                </button>
                            </div>
                            <div id="accordion-collapse-3-3" class="collapse" aria-labelledby="accordion-heading-3-3"
                                data-bs-target="#accordion-3">
                                <div class="card-body">
                                    <p>Ujian wawancara dan tes literasi akan dilaksanakan di SMA Negeri 3 Banda Aceh.</p>
                                    <p>Peserta diwajibkan:</p>
                                    <ul>
                                        <li>Datang tepat waktu sesuai jadwal</li>
                                        <li>Mengenakan seragam resmi SMP/MTs asal</li>
                                        <li>Membawa dokumen pendukung seperti kartu peserta SPMB</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- /section -->
    <section class="wrapper bg-soft-primary angled upper-start">
        <div class="container py-14 pt-md-16 pt-lg-0 pb-md-16">
            <!--/.row -->
            <div class="row text-center">
                <div class="col-lg-12 mx-auto">
                    <h2 class="fs-15 text-uppercase text-muted mb-3 mt-12">SPMB</h2>
                    <h3 class="display-4 mb-0 text-center px-xl-10 px-xxl-15">Pendaftaran SPMB SMA NEGERI 3 BANDA ACEH</h3>
                    <div class="row gx-lg-8 gx-xl-12 process-wrapper text-center mt-9">
                        <div class="col-lg-2">
                            <img src="{{ asset('assets/icons/solid/marker.svg') }}"
                                class="svg-inject icon-svg icon-svg-xs solid-mono text-primary" alt="" />
                            <h4 class="mb-1">1. Daftar Akun SPMB</h4>
                            <p>Buat atau Masuk Akun SPMB SMA NEGERI 3 BANDA ACEH untuk pengalaman pendaftaran yang mudah dan
                                cepat.</p>
                        </div>
                        <!--/column -->
                        <div class="col-lg-2">
                            <img src="{{ asset('assets/icons/solid/note.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-red mb-3" alt="" />
                            <h4 class="mb-1">2. Masukan Data Diri</h4>
                            <p>Isi data diri dengan lengkap dan benar untuk melanjutkan proses pendaftaran.</p>
                        </div>
                        <!--/column -->
                        <div class="col-lg-2">
                            <img src="{{ asset('assets/icons/lineal/download.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-leaf mb-3" alt="" />
                            <h4 class="mb-1">3. Unduh Formulir</h4>
                            <p>Unduh dan cetak formulir pendaftaran yang telah diisi.</p>
                        </div>
                        <!--/column -->
                        <div class="col-lg-2">
                            <img src="{{ asset('assets/icons/lineal/files.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-yellow mb-3" alt="" />
                            <h4 class="mb-1">4. Bawa Berkas</h4>
                            <p>Bawa berkas yang diperlukan untuk verifikasi ke sekolah.</p>
                        </div>
                        <!--/column -->
                        <div class="col-lg-2">
                            <img src="{{ asset('assets/icons/lineal/smartphone-2.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-blue mb-3" alt="" />
                            <h4 class="mb-1">5. Diseleksi</h4>
                            <p>Ikuti proses seleksi yang telah dijadwalkan.</p>
                        </div>
                        <!--/column -->
                        <div class="col-lg-2">
                            <img src="{{ asset('assets/icons/lineal/paper.svg') }}"
                                class="svg-inject icon-svg icon-svg-md text-purple mb-3" alt="" />
                            <h4 class="mb-1">6. Ujian</h4>
                            <p>Ikuti ujian masuk sesuai dengan jadwal yang telah ditentukan.</p>
                        </div>
                        <!--/column -->
                    </div>
                    <!--/.row -->
                </div>
                <!-- /column -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->

    <!-- Modal -->
    <div class="modal fade" id="ppdbModal" tabindex="-1" aria-labelledby="ppdbModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ppdbModalLabel">Informasi Penting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Pengumuman hasil seleksi telah keluar!</strong></p>
                    <p>Silakan cek jadwal dan informasi tahap selanjutnya untuk seleksi SPMB.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ppdbModal = new bootstrap.Modal(document.getElementById('ppdbModal'));
            ppdbModal.show();
        });
    </script>
@endsection
