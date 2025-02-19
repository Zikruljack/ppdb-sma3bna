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
                </div>
            </div>
            <div class="card-body">
                <h2 class="text-center">FORMULIR PENDAFTARAN ONLINE PPDB 2025/2026</h2>
                <h3 class="text-center">SMA NEGERI 3 BANDA ACEH</h3>
                <hr>
                <div class="text-center mb-3">
                    <img src="{{ asset('storage/' . $ppdbUser->foto) }}" alt="Foto Calon Peserta" class="img-thumbnail"
                        width="150">
                </div>
                <hr>
                <table class="table table-bordered">
                    <tr>
                        <th>Nomor Registrasi</th>
                        <td>{{ $ppdbUser->nomor_peserta }}</td>
                    </tr>
                    <tr>
                        <th>Jalur Tes</th>
                        <td>{{ $ppdbUser->jalur_pendaftaran }}</td>
                    </tr>
                    <tr>
                        <th>Nama Calon Peserta Didik</th>
                        <td>{{ $ppdbUser->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $ppdbUser->nik }}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td>{{ $ppdbUser->nisn }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $ppdbUser->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Tempat, Tanggal Lahir</th>
                        <td>{{ $ppdbUser->tempat_lahir }}, {{ $ppdbUser->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $ppdbUser->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Kabupaten/Kota</th>
                        <td>{{ $kabkota->name }}</td>
                    </tr>
                    <tr>
                        <th>Provinsi</th>
                        <td>{{ $provinsi->name }}</td>
                    </tr>
                    <tr>
                        <th>Golongan Darah</th>
                        <td>{{ $ppdbUser->gol_darah }}</td>
                    </tr>
                    <tr>
                        <th>Tinggi Badan</th>
                        <td>{{ $ppdbUser->tinggi_badan }} cm</td>
                    </tr>
                    <tr>
                        <th>Berat Badan</th>
                        <td>{{ $ppdbUser->berat_badan }} kg</td>
                    </tr>
                    <tr>
                        <th>Nama Sekolah Asal</th>
                        <td>{{ $ppdbUser->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>NPSN Sekolah</th>
                        <td>{{ $ppdbUser->npsn_asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>Kabupaten/Kota Sekolah Asal</th>
                        <td>{{ $ppdbUser->kabkota_asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>Nama Ayah</th>
                        <td>{{ $ppdbUser->nama_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Ayah</th>
                        <td>{{ $ppdbUser->pekerjaan_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Nama Ibu</th>
                        <td>{{ $ppdbUser->nama_ibu }}</td>
                    </tr>
                    <tr>
                        <th>Pekerjaan Ibu</th>
                        <td>{{ $ppdbUser->pekerjaan_ibu }}</td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td>{{ $ppdbUser->no_hp }}</td>
                    </tr>
                </table>

                <br>

                <h4>Nilai Rapor</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Semester</th>
                            <th>PAI</th>
                            <th>Bahasa Indonesia</th>
                            <th>Bahasa Inggris</th>
                            <th>Matematika</th>
                            <th>IPA</th>
                            <th>IPS</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiRapor as $semester => $nilaiSemester)
                            <tr>
                                <td>{{ $semester }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'PAI')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Bahasa Indonesia')->nilai ?? '-' }}
                                </td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Bahasa Inggris')->nilai ?? '-' }}
                                </td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Matematika')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'IPA')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'IPS')->nilai ?? '-' }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $nilaiSemester->firstWhere('mapel.mapel', 'PAI')->scan_rapor) }}"
                                        target="_blank" class="btn btn-info">
                                        <i class="fas fa-file-alt"></i> Lihat File
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <br>

                {{-- berkas pendukung --}}
                <h4>Berkas Pendukung</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Berkas</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Kartu Keluarga</td>
                            <td>
                                @if (!empty($berkasPendukung->kk_file))
                                    <a href="{{ asset('storage/' . $berkasPendukung->kk_file) }}" target="_blank"
                                        class="btn btn-info">
                                        <i class="fas fa-file-alt"></i> Lihat File
                                    </a>
                                @else
                                    <span class="text-danger">Berkas belum diunggah</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Akta Kelahiran</td>
                            <td>
                                @if (!empty($berkasPendukung->akta_kelahiran_file))
                                    <a href="{{ asset('storage/' . $berkasPendukung->akta_kelahiran_file) }}"
                                        target="_blank" class="btn btn-info">
                                        <i class="fas fa-file-alt"></i> Lihat File
                                    </a>
                                @else
                                    <span class="text-danger">Berkas belum diunggah</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Surat Keterangan Aktif</td>
                            <td>
                                @if (!empty($berkasPendukung->surat_keterangan_aktif))
                                    <a href="{{ asset('storage/' . $berkasPendukung->surat_keterangan_aktif) }}"
                                        target="_blank" class="btn btn-info">
                                        <i class="fas fa-file-alt"></i> Lihat File
                                    </a>
                                @else
                                    <span class="text-danger">Berkas belum diunggah</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

                <br>

                <h4>Sertifikat Akademik</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Berkas</th>
                            <th>Tingkat Kejuaraan</th>
                            <th>Juara</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sertifikat->where('jenis_sertifikat', 'akademik')->isNotEmpty())
                            @foreach ($sertifikat->where('jenis_sertifikat', 'akademik') as $sertifikatAkademik)
                                <tr>
                                    <td>{{ $sertifikatAkademik->nama_sertifikat }}</td>
                                    <td>{{ $sertifikatAkademik->tingkat_kejuaraan }}</td>
                                    <td>{{ $sertifikatAkademik->juara }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $sertifikatAkademik->file) }}" target="_blank"
                                            class="btn btn-info">
                                            <i class="fas fa-file-alt"></i> Lihat File
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada sertifikat akademik</td>
                            </tr>
                        @endif

                    </tbody>
                </table>

                <br>

                <h4>Sertifikat Non Akademik</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Berkas</th>
                            <th>Tingkat Kejuaraan</th>
                            <th>Juara</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sertifikat->where('jenis_sertifikat', 'non akademik')->isNotEmpty())
                            @foreach ($sertifikat->where('jenis_sertifikat', 'non akademik') as $sertifikatNonAkademik)
                                <tr>
                                    <td>{{ $sertifikatNonAkademik->nama_sertifikat }}</td>
                                    <td>{{ $sertifikatNonAkademik->tingkat_kejuaraan }}</td>
                                    <td>{{ $sertifikatNonAkademik->juara }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $sertifikatNonAkademik->file) }}" target="_blank"
                                            class="btn btn-info">
                                            <i class="fas fa-file-alt"></i> Lihat File
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada sertifikat non akademik</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
