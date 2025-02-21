@extends('adminlte::page')

@section('title', 'Validasi Peserta')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Validasi Peserta</h3>
                    </div>
                    <div class="card-body">
                        <form id="validateForm" action="{{ route('admin.ppdb.validasi', $ppdbUser->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $ppdbUser->id }}">
                            {{-- keterangan User Validasi --}}
                            <div class="form-group">
                                <label for="user_info">Informasi Peserta</label>
                                <ul class="list-group">
                                    <li class="list-group-item"><strong>Nama Lengkap:</strong> {{ $ppdbUser->nama_lengkap }}
                                    </li>
                                    <li class="list-group-item"><strong>NISN:</strong> {{ $ppdbUser->nisn }}</li>
                                    <li class="list-group-item"><strong>Jalur Pendaftaran:</strong>
                                        {{ ucfirst($ppdbUser->jalur_pendaftaran) }}</li>
                                </ul>
                            </div>
                            <div class="text-center mb-3">
                                @if (!empty($ppdbUser->foto))
                                    <img src="{{ asset('storage/' . $ppdbUser->foto) }}" alt="Foto Calon Peserta"
                                        class="img-thumbnail" width="150">
                                @else
                                    <span class="text-danger">Foto belum diunggah</span>
                                @endif
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
                                    <th>No. HP</th>
                                    <td>{{ $ppdbUser->no_hp }}</td>
                                </tr>
                            </table>

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
                                        <th>Rata Rata</th>
                                        <th>File</th>
                                        <th>Validasi</th>
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
                                            <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Matematika')->nilai ?? '-' }}
                                            </td>
                                            <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'IPA')->nilai ?? '-' }}</td>
                                            <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'IPS')->nilai ?? '-' }}</td>
                                            <td class="nilai-rata-rata">{{ $nilaiRataRata[$semester] }}</td>
                                            <td>
                                                <a href="{{ asset('storage/' . $nilaiSemester->firstWhere('mapel.mapel', 'PAI')->scan_rapor) }}"
                                                    target="_blank" class="btn btn-info">
                                                    <i class="fas fa-file-alt"></i> Lihat File
                                                </a>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="rapor-validasi">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <h4>Berkas Pendukung</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Berkas</th>
                                        <th>File</th>
                                        {{-- <th>Validasi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Kartu Keluarga</td>
                                        <td>
                                            @if (!empty($berkasPendukung->kk_file))
                                                <a href="{{ asset('storage/' . $berkasPendukung->kk_file) }}"
                                                    target="_blank" class="btn btn-info">
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
                                    @if ($ppdbUser->jalur_pendaftaran == 'kepemimpinan')
                                        <tr>
                                            <td>Surat Keterangan OSIS/OSIM</td>
                                            <td>
                                                @if (!empty($berkasPendukung->sk_ketua_osis))
                                                    <a href="{{ asset('storage/' . $berkasPendukung->sk_ketua_osis) }}"
                                                        target="_blank" class="btn btn-info">
                                                        <i class="fas fa-file-alt"></i> Lihat File
                                                    </a>
                                                @else
                                                    <span class="text-danger">Berkas belum diunggah</span>
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" id="sk-osis" class="sk-osis">
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                            <h4>Sertifikat Akademik</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Berkas</th>
                                        <th>Tingkat Kejuaraan</th>
                                        <th>Juara</th>
                                        <th>File</th>
                                        <th>Validasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sertifikat->where('jenis_sertifikat', 'akademik') as $sertifikatAkademik)
                                        <tr>
                                            <td>{{ $sertifikatAkademik->nama_sertifikat }}</td>
                                            {{-- {{ dd($sertifikatAkademik->id) }} --}}
                                            <td>
                                                <select class="form-control edit-tingkat"
                                                    data-id="{{ $sertifikatAkademik->id }}">
                                                    <option value="kabupaten"
                                                        {{ $sertifikatAkademik->tingkat_kejuaraan == 'kabupaten' ? 'selected' : '' }}>
                                                        Kabupaten</option>
                                                    <option value="kota"
                                                        {{ $sertifikatAkademik->tingkat_kejuaraan == 'kota' ? 'selected' : '' }}>
                                                        Kota</option>
                                                    <option value="provinsi"
                                                        {{ $sertifikatAkademik->tingkat_kejuaraan == 'provinsi' ? 'selected' : '' }}>
                                                        Provinsi</option>
                                                    <option value="nasional"
                                                        {{ $sertifikatAkademik->tingkat_kejuaraan == 'nasional' ? 'selected' : '' }}>
                                                        Nasional</option>
                                                    <option value="internasional"
                                                        {{ $sertifikatAkademik->tingkat_kejuaraan == 'internasional' ? 'selected' : '' }}>
                                                        Internasional</option>
                                                </select>
                                            </td>
                                            <td><select class="form-control edit-juara">
                                                    <option value="juara 1"
                                                        {{ $sertifikatAkademik->juara == 'juara 1' ? 'selected' : '' }}>
                                                        Juara 1</option>
                                                    <option value="juara 2"
                                                        {{ $sertifikatAkademik->juara == 'juara 2' ? 'selected' : '' }}>
                                                        Juara 2</option>
                                                    <option value="juara 3"
                                                        {{ $sertifikatAkademik->juara == 'juara 3' ? 'selected' : '' }}>
                                                        Juara 3</option>
                                                    <option value="tidak ada kejuaraan"
                                                        {{ $sertifikatAkademik->juara == 'tidak ada kejuaraan' ? 'selected' : '' }}>
                                                        Tidak Ada Kejuaraan</option>
                                                </select></td>
                                            <td>
                                                <a href="{{ asset('storage/' . $sertifikatAkademik->file_path) }}"
                                                    target="_blank" class="btn btn-info">
                                                    <i class="fas fa-file-alt"></i> Lihat File
                                                </a>
                                            </td>
                                            <td>
                                                <input type="checkbox" class="sertifikat-validasi"
                                                    data-tingkat="{{ $sertifikatAkademik->tingkat_kejuaraan }}"
                                                    data-juara="{{ $sertifikatAkademik->juara }}"
                                                    data-jenis="{{ $sertifikatAkademik->jenis_sertifikat }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <h4>Sertifikat Non Akademik</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Berkas</th>
                                        <th>Tingkat Kejuaraan</th>
                                        <th>Juara</th>
                                        <th>File</th>
                                        <th>Validasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($sertifikat->where('jenis_sertifikat', 'non akademik')->isNotEmpty())
                                        @foreach ($sertifikat->where('jenis_sertifikat', 'non akademik') as $sertifikatNonAkademik)
                                            <tr>
                                                <td>{{ $sertifikatNonAkademik->nama_sertifikat }}</td>
                                                <td>
                                                    <select class="form-control edit-tingkat"
                                                        data-id="{{ $sertifikatNonAkademik->id }}">
                                                        <option value="kabupaten"
                                                            {{ $sertifikatNonAkademik->tingkat_kejuaraan == 'kabupaten' ? 'selected' : '' }}>
                                                            Kabupaten</option>
                                                        <option value="kota"
                                                            {{ $sertifikatNonAkademik->tingkat_kejuaraan == 'kota' ? 'selected' : '' }}>
                                                            Kota</option>
                                                        <option value="provinsi"
                                                            {{ $sertifikatNonAkademik->tingkat_kejuaraan == 'provinsi' ? 'selected' : '' }}>
                                                            Provinsi</option>
                                                        <option value="nasional"
                                                            {{ $sertifikatNonAkademik->tingkat_kejuaraan == 'nasional' ? 'selected' : '' }}>
                                                            Nasional</option>
                                                        <option value="internasional"
                                                            {{ $sertifikatNonAkademik->tingkat_kejuaraan == 'internasional' ? 'selected' : '' }}>
                                                            Internasional</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control edit-juara">
                                                        <option value="juara 1"
                                                            {{ $sertifikatNonAkademik->juara == 'juara 1' ? 'selected' : '' }}>
                                                            Juara 1</option>
                                                        <option value="juara 2"
                                                            {{ $sertifikatNonAkademik->juara == 'juara 2' ? 'selected' : '' }}>
                                                            Juara 2</option>
                                                        <option value="juara 3"
                                                            {{ $sertifikatNonAkademik->juara == 'juara 3' ? 'selected' : '' }}>
                                                            Juara 3</option>
                                                        <option value="tidak ada kejuaraan"
                                                            {{ $sertifikatNonAkademik->juara == 'tidak ada kejuaraan' ? 'selected' : '' }}>
                                                            Tidak Ada Kejuaraan</option>
                                                    </select>
                                                </td>
                                                {{-- <td>{{ $sertifikatNonAkademik->juara }}</td> --}}
                                                <td>
                                                    <a href="{{ asset('storage/' . $sertifikatNonAkademik->file_path) }}"
                                                        target="_blank" class="btn btn-info">
                                                        <i class="fas fa-file-alt"></i> Lihat File
                                                    </a>
                                                </td>
                                                <td>
                                                    <input type="checkbox" class="sertifikat-validasi"
                                                        data-tingkat="{{ $sertifikatNonAkademik->tingkat_kejuaraan }}"
                                                        data-juara="{{ $sertifikatNonAkademik->juara }}"
                                                        data-jenis="{{ $sertifikatNonAkademik->jenis_sertifikat }}">
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

                            <h4>Hasil Penilaian</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nilai Rapor</th>
                                        <th>Nilai Sertifikat</th>
                                        <th>Nilai Ujian</th>
                                        <th>Nilai Baca Quran</th>
                                        <th>Total Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="nilai-rapor">0</td>
                                        <td id="nilai-sertifikat">0</td>
                                        <td id="nilai-ujian">0</td>
                                        <td id="nilai-baca-quran">0</td>
                                        <td id="total-nilai">0</td>
                                    </tr>
                                </tbody>
                            </table>

                            <input type="hidden" name="nilai_rapor" id="input-nilai-rapor">
                            <input type="hidden" name="nilai_sertifikat" id="input-nilai-sertifikat">
                            {{-- <input type="hidden" name="total_nilai" id="input-total-nilai"> --}}

                            <div class="form-group">
                                <label for="status">Status Validasi</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="valid">Valid</option>
                                    <option value="tidak_valid">Tidak Valid</option>
                                    <option value="perbaikan">Perlu Perbaikan Data</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="note_validasi">Note Validasi</label>
                                <textarea name="note_validasi" id="note_validasi" class="form-control"></textarea>
                            </div>
                            <button type="button" id="validateButton" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            function hitungTotalNilai() {
                let totalNilai = 0;
                let nilaiRapor = 0;
                let nilaiSertifikat = 0;

                // Hitung Nilai Rapor
                let totalRataRata = 0;
                let jumlahSemester = 0;
                let semuaChecked = $(".rapor-validasi").length > 0;

                $(".rapor-validasi").each(function() {
                    if (!$(this).prop("checked")) {
                        semuaChecked = false;
                    }
                });

                if (semuaChecked) {
                    $(".nilai-rata-rata").each(function() {
                        totalRataRata += parseFloat($(this).text()) || 0;
                        jumlahSemester++;
                    });

                    if (jumlahSemester > 0) {
                        nilaiRapor = (totalRataRata / jumlahSemester) * 0.6;
                    }
                }

                // Cek apakah SK OSIS dicentang
                if ($('#sk-osis').prop("checked")) {
                    nilaiSertifikat += 40 * 0.4;
                }

                let totalNilaiSertifikatAkademik = 0;
                let totalNilaiSertifikatNonAkademik = 0;
                let jumlahSertifikatAkademik = 0;
                let jumlahSertifikatNonAkademik = 0;

                $(".sertifikat-validasi:checked").each(function() {
                    let tingkat = $(this).closest("tr").find(".edit-tingkat").val().toLowerCase();
                    let juaraText = $(this).closest("tr").find('.edit-juara').val().toLowerCase();
                    let jenis = $(this).data("jenis");
                    let nilai = 0;

                    let juara = parseInt(juaraText.replace("juara ", ""));

                    console.log("Tingkat:", tingkat, "Juara:", juara, "Jenis:", jenis);

                    const nilaiJuara = {
                        "kabupaten": {
                            1: 30,
                            2: 20,
                            3: 10
                        },
                        "kota": {
                            1: 30,
                            2: 20,
                            3: 10
                        },
                        "provinsi": {
                            1: 50,
                            2: 40,
                            3: 30
                        },
                        "nasional": {
                            1: 70,
                            2: 60,
                            3: 50
                        },
                        "internasional": {
                            1: 100,
                            2: 80,
                            3: 70
                        }
                    };

                    if (nilaiJuara[tingkat] && nilaiJuara[tingkat][juara]) {
                        nilai = nilaiJuara[tingkat][juara];
                    } else {
                        console.warn("Nilai tidak ditemukan untuk:", tingkat, "Juara:", juara);
                    }

                    if (jenis === "akademik") {
                        totalNilaiSertifikatAkademik += nilai;
                        jumlahSertifikatAkademik++;
                    } else {
                        totalNilaiSertifikatNonAkademik += nilai;
                        jumlahSertifikatNonAkademik++;
                    }
                });

                // Hitung nilai akhir dengan membagi jumlah sertifikat
                let nilaiSertifikatAkademik = jumlahSertifikatAkademik > 0 ? totalNilaiSertifikatAkademik /
                    jumlahSertifikatAkademik : 0;
                let nilaiSertifikatNonAkademik = jumlahSertifikatNonAkademik > 0 ? totalNilaiSertifikatNonAkademik /
                    jumlahSertifikatNonAkademik : 0;

                console.log("Nilai Akhir Akademik:", nilaiSertifikatAkademik);
                console.log("Nilai Akhir Non-Akademik:", nilaiSertifikatNonAkademik);


                let totalSertifikat = (nilaiSertifikatAkademik * 0.7) + (nilaiSertifikatNonAkademik * 0.3);
                nilaiSertifikat += totalSertifikat * 0.2;

                // Hitung Total Nilai
                totalNilai = nilaiRapor + nilaiSertifikat;

                // Update tampilan
                $("#nilai-rapor").text(nilaiRapor.toFixed(2));
                $("#nilai-sertifikat").text(nilaiSertifikat.toFixed(2));
                $("#total-nilai").text(totalNilai.toFixed(2));

                // Update input hidden sebelum dikirim
                $("#input-nilai-rapor").val(nilaiRapor.toFixed(2));
                $("#input-nilai-sertifikat").val(nilaiSertifikat.toFixed(2));
                $("#input-total-nilai").val(totalNilai.toFixed(2));
            }

            // Event listener untuk perubahan nilai rapor dan sertifikat
            $(".rapor-validasi, .sertifikat-validasi, #sk-osis").on("change", function() {
                hitungTotalNilai();
            });

            // Event listener untuk perubahan tingkat kejuaraan
            $(".edit-tingkat").on("blur", function() {
                let row = $(this).closest("tr");
                let id = $(this).data("id");
                let tingkat_kejuaraan = $(this).val();
                let juara_text = $(this).closest("tr").find(".edit-juara").val();
                console.log(id);
                let url =
                    "{{ route('admin.ppdb.validasi.penilaian.update.sertifikat', ['id' => $ppdbUser->id, 'id_sertifikat' => '__ID__']) }}";

                // Ganti placeholder __ID__ dengan nilai id dari JavaScript
                url = url.replace('__ID__', id);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        tingkat_kejuaraan: tingkat_kejuaraan,
                        juara: juara_text
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Tingkat kejuaraan diperbarui.',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        hitungTotalNilai(); // Hitung ulang nilai setelah update tingkat
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Gagal memperbarui data.'
                        });
                    }
                });
            });

            // Event listener untuk validasi dengan SweetAlert2
            $("#validateButton").on("click", function() {
                hitungTotalNilai(); // Pastikan nilai terbaru dihitung sebelum submit

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data akan divalidasi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, validasi!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#validateForm").submit();
                    }
                });
            });

            // Panggil fungsi pertama kali saat halaman dimuat
            hitungTotalNilai();
        });
    </script>

@endsection
