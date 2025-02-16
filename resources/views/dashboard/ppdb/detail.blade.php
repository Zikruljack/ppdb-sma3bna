@extends('adminlte::page')

@section('title', 'Detail Peserta')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white justify-content-between">
                <div class="row">
                    <div class="col-6 text-left">
                        <span>Formulir Pendaftaran Online PPDB 2024 / 2025</span>
                    </div>
                    <div class="col-6 text-right">
                        <button class="btn btn-success">Validasi</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h5>Nomor Registrasi: {{ $data->nomor_peserta }}</h5>
                <p><strong>Jalur Tes:</strong> {{ ucfirst($data->jalur_pendaftaran) }}</p>

                <h5 class="mt-3">Data Diri</h5>
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto Calon Peserta" class="img-thumbnail"
                        width="150">
                </div>
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>{{ $data->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td><strong>NIK</strong></td>
                        <td>{{ $data->nik }}</td>
                    </tr>
                    <tr>
                        <td><strong>NISN</strong></td>
                        <td>{{ $data->nisn }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Kelamin</strong></td>
                        <td>{{ $data->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tempat, Tanggal Lahir</strong></td>
                        <td>{{ $data->tempat_lahir }}, {{ $data->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat</strong></td>
                        <td>{{ $data->alamat }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kabupaten/Kota</strong></td>
                        <td>{{ $kabkota->name ?? 'Tidak Diketahui' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Provinsi</strong></td>
                        <td>{{ $provinsi->name ?? 'Tidak Diketahui' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Golongan Darah</strong></td>
                        <td>{{ $data->gol_darah }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tinggi Badan</strong></td>
                        <td>{{ $data->tinggi_badan }} cm</td>
                    </tr>
                    <tr>
                        <td><strong>Berat Badan</strong></td>
                        <td>{{ $data->berat_badan }} kg</td>
                    </tr>
                </table>

                <h5 class="mt-3">Sekolah Asal</h5>
                <table class="table table-bordered">
                    <tr>
                        <td><strong>NPSN</strong></td>
                        <td>{{ $data->npsn_asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Sekolah</strong></td>
                        <td>{{ $data->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kabupaten/Kota</strong></td>
                        <td>{{ $data->kabkota_asal_sekolah }}</td>
                    </tr>
                </table>

                <h5 class="mt-3">Data Orang Tua</h5>
                <table class="table table-bordered">
                    <tr>
                        <td><strong>Nama Ayah</strong></td>
                        <td>{{ $data->nama_ayah }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Ibu</strong></td>
                        <td>{{ $data->nama_ibu }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pekerjaan Ayah</strong></td>
                        <td>{{ $data->pekerjaan_ayah }}</td>
                    </tr>
                    <tr>
                        <td><strong>Pekerjaan Ibu</strong></td>
                        <td>{{ $data->pekerjaan_ibu }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jabatan Ayah</strong></td>
                        <td>{{ $data->jabatan_ayah }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jabatan Ibu</strong></td>
                        <td>{{ $data->jabatan_ibu }}</td>
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
                        @foreach ($nilaiRapor as $semester => $nilaiSemester)
                            <tr>
                                <td>{{ $semester }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'PAI')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Bahasa Indonesia')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Bahasa Inggris')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Matematika')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'IPA')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'IPS')->nilai ?? '-' }}</td>
                            </tr>
                        @endforeach
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
