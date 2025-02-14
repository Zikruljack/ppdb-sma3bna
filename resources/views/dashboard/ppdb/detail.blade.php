@extends('adminlte::page')

@section('title', 'Detail Peserta')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">Formulir Pendaftaran Online PPDB 2024 / 2025</div>
            <div class="card-body">
                <h5>Nomor Registrasi: 328</h5>
                <p><strong>Jalur Tes:</strong> Prestasi Akademik dan Non Akademik</p>

                <h5 class="mt-3">Data Diri</h5>
                <div class="text-center mb-3">
                    <img src="https://picsum.photos/150/150" alt="Foto Calon Peserta" class="img-thumbnail" width="150">
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>RIDHO HIZBULLAH</td>
                    </tr>
                    <tr>
                        <td><strong>NIK</strong></td>
                        <td>1171081501090002</td>
                    </tr>
                    <tr>
                        <td><strong>NISN</strong></td>
                        <td>3093302779</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Kelamin</strong></td>
                        <td>Laki-Laki</td>
                    </tr>
                    <tr>
                        <td><strong>Tempat, Tanggal Lahir</strong></td>
                        <td>Banda Aceh, 15-01-2009</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td>Jl. Nasruddin Rasyid Dsn Bungong Meulu, Emperum, Jaya Baru</td>
                    </tr>
                    <tr>
                        <td><strong>Kabupaten/Kota</strong></td>
                        <td>Banda Aceh</td>
                    </tr>
                    <tr>
                        <td><strong>Provinsi</strong></td>
                        <td>Aceh</td>
                    </tr>
                    <tr>
                        <td><strong>Golongan Darah</strong></td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td><strong>Tinggi Badan</strong></td>
                        <td>156 cm</td>
                    </tr>
                    <tr>
                        <td><strong>Berat Badan</strong></td>
                        <td>60 kg</td>
                    </tr>
                </table>

                <h5 class="mt-3">Sekolah Asal</h5>
                <table class="table table-bordered">
                    <tr>
                        <td><strong>NPSN</strong></td>
                        <td>10105436</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Sekolah</strong></td>
                        <td>SMP NEGERI 1 BANDA ACEH</td>
                    </tr>
                    <tr>
                        <td><strong>Kabupaten/Kota</strong></td>
                        <td>Banda Aceh</td>
                    </tr>
                </table>

                <h5 class="mt-3">Data Orang Tua</h5>
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Nama Ayah</strong></td>
                        <td>Samsul Bahri</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Ibu</strong></td>
                        <td>Nuraida</td>
                    </tr>
                    <tr>
                        <td><strong>Pekerjaan Ayah</strong></td>
                        <td>Polri</td>
                    </tr>
                    <tr>
                        <td><strong>Pekerjaan Ibu</strong></td>
                        <td>Polri</td>
                    </tr>
                    <tr>
                        <td><strong>Jabatan Ayah</strong></td>
                        <td>Kapolsek Ulee Kareng</td>
                    </tr>
                    <tr>
                        <td><strong>Jabatan Ibu</strong></td>
                        <td>Polri</td>
                    </tr>
                </table>

                <h5 class="mt-3">Nilai Rapor</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Semester</th>
                            <th>Agama</th>
                            <th>Bahasa Indonesia</th>
                            <th>Bahasa Inggris</th>
                            <th>Matematika</th>
                            <th>IPA</th>
                            <th>IPS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>3</td>
                            <td>86</td>
                            <td>90</td>
                            <td>86</td>
                            <td>86</td>
                            <td>86</td>
                            <td>86</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>86</td>
                            <td>88</td>
                            <td>86</td>
                            <td>86</td>
                            <td>87</td>
                            <td>86</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>88</td>
                            <td>86</td>
                            <td>86</td>
                            <td>90</td>
                            <td>86</td>
                            <td>86</td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="mt-3">Data Prestasi Akademik</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Prestasi</th>
                            <th>Penyelenggara</th>
                            <th>Tingkat Lomba</th>
                            <th>Juara</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data</td>
                        </tr>
                    </tbody>
                </table>

                <h5 class="mt-3">Data Prestasi Non Akademik</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Prestasi</th>
                            <th>Penyelenggara</th>
                            <th>Tingkat Lomba</th>
                            <th>Juara</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
