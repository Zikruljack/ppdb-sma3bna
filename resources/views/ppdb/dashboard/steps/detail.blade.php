@extends('ppdb.dashboard.formulir')


@section('form-content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">FORMULIR PENDAFTARAN ONLINE PPDB 2025/2026</h2>
                <h3 class="text-center">SMA NEGERI 3 BANDA ACEH</h3>
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
                        <td>{{ $ppdbUser->kabkota_asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>Provinsi</th>
                        <td>{{ $ppdbUser->provinsi }}</td>
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
                            <th style="width: 10%;">Semester</th>
                            <th style="width: 15%;">PAI</th>
                            <th style="width: 15%;">Bahasa Indonesia</th>
                            <th style="width: 15%;">Bahasa Inggris</th>
                            <th style="width: 15%;">Matematika</th>
                            <th style="width: 15%;">IPA</th>
                            <th style="width: 15%;">IPS</th>
                            <th>Berkas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nilaiRapor as $semester => $nilaiSemester)
                            {{-- {{ dd($nilaiSemester) }} --}}
                            <tr>
                                <td>{{ $semester }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'PAI')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Bahasa Indonesia')->nilai ?? '-' }}</td>
                                <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Bahasa Inggris')->nilai ?? '-' }}</td>
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
                        {{-- {{ dd($ppdbUser->jalur_pendaftaran) }} --}}
                        @if ($ppdbUser->jalur_pendaftaran == 'kepemimpinan')
                            <tr>
                                <td>Surat Keterangan OSIS/OSIM</td>
                                <td>
                                    @if (!empty($berkasPendukung->sk_ketua_osis))
                                        <a href="{{ asset('storage/' . $berkasPendukung->sk_ketua_osis) }}" target="_blank"
                                            class="btn btn-info">
                                            <i class="fas fa-file-alt"></i> Lihat File
                                        </a>
                                    @else
                                        <span class="text-danger">Berkas belum diunggah</span>
                                    @endif
                                </td>
                            </tr>
                        @endif
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
                                {{-- {{ dd($sertifikatAkademik) }} --}}
                                <tr>
                                    <td>{{ $sertifikatAkademik->nama_sertifikat }}</td>
                                    <td>{{ $sertifikatAkademik->tingkat_kejuaraan }}</td>
                                    <td>{{ $sertifikatAkademik->juara }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $sertifikatAkademik->file_path) }}" target="_blank"
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
                                        <a href="{{ asset('storage/' . $sertifikatNonAkademik->file_path) }}"
                                            target="_blank" class="btn btn-info">
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

                <div class="text-center mt-4">
                    <form id="finalizeForm" action="{{ route('ppdb.formulir.finalisasi') }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-primary @if ($ppdbUser->status == 'Pendaftar' || $ppdbUser->status == 'Perbaikan') @else d-none @endif"
                            onclick="confirmFinalization()">Finalisasi</button>
                    </form>
                    @if ($ppdbUser->status == 'Final')
                        <a href="{{ route('ppdb.download', $ppdbUser->id) }}" class="btn btn-success">Download Formulir</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmFinalization() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Apakah anda yakin sudah benar semua data diri ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('finalizeForm').submit();
                    document.querySelector('button[onclick="confirmFinalization()"]').style.display = 'none';
                }
            });
        }
    </script>
@endsection
