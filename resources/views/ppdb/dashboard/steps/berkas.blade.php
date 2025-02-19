@extends('ppdb.dashboard.formulir')

@section('form-content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Upload Berkas Jalur {{ strtoupper($ppdbUser->jalur_pendaftaran) }}</h5>
        </div>

        <div class="card-body">

            <div class="alert alert-info">
                <h5 class="alert-heading"><i class="fas fa-info-circle"></i> Note :</h5>
                <ul>
                    <li>File yang diupload harus berekstensi <strong>pdf, jpg, png</strong> dan max file
                        <strong>2MB</strong>.
                    </li>
                    <li>Jika ada data yang kosong, maka diisi dengan <strong>"-".</strong></li>
                    @if ($ppdbUser->jalur_pendaftaran == 'kepemimpinan')
                        <li>Untuk sertifikat kepemimpinan, ketua OSIS/OSIM harus mengupload berkas dari surat Keputusan
                            Kepala satuan pendidikan atau Kepala Sekolah.</li>
                    @endif
                </ul>
            </div>
            <form action="{{ route('ppdb.formulir.berkas.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($ppdbUser->status == 'Final')
                    <div class="alert alert-warning">
                        Data tidak bisa diubah karena anda sudah memfinalisasi.
                    </div>
                @else
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                                @if ($berkasPendukung && $berkasPendukung->kk_file)
                                    <a href="{{ asset('storage/' . $berkasPendukung->kk_file) }}" target="_blank"
                                        class="btn btn-info">
                                        <i class="fas fa-file-alt"></i> Lihat File
                                    </a>
                                    <input type="file" class="form-control mt-2 @error('kk') is-invalid @enderror"
                                        name="kk" accept="images/*, application/pdf"
                                        value="{{ asset('storage/' . $berkasPendukung->kk_file) }}">
                                    @error('kk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @else
                                    <input type="file" class="form-control @error('kk') is-invalid @enderror"
                                        name="kk" accept="images/*, application/pdf" required>
                                    @error('kk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Surat Keterangan Aktif Sekolah <span class="text-danger">*</span></label>
                                @if ($berkasPendukung && $berkasPendukung->surat_keterangan_aktif)
                                    <a href="{{ asset('storage/' . $berkasPendukung->surat_keterangan_aktif) }}"
                                        target="_blank" class="btn btn-info">
                                        <i class="fas fa-file-alt"></i> Lihat File
                                    </a>
                                    <input type="file"
                                        class="form-control mt-2 @error('surat_keterangan_aktif') is-invalid @enderror"
                                        name="surat_keterangan_aktif" accept="images/*, application/pdf"
                                        value="{{ asset('storage/' . $berkasPendukung->surat_keterangan_aktif) }}">
                                    @error('surat_keterangan_aktif')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @else
                                    <input type="file"
                                        class="form-control @error('surat_keterangan_aktif') is-invalid @enderror"
                                        accept="images/*, application/pdf" name="surat_keterangan_aktif" required>
                                    @error('surat_keterangan_aktif')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Akta Kelahiran <span class="text-danger">*</span></label>
                                @if ($berkasPendukung && $berkasPendukung->akta_kelahiran_file)
                                    <a href="{{ asset('storage/' . $berkasPendukung->akta_kelahiran_file) }}"
                                        target="_blank" class="btn btn-info">
                                        <i class="fas fa-file-alt"></i> Lihat File
                                    </a>
                                    <input type="file" class="form-control mt-2 @error('akta') is-invalid @enderror"
                                        name="akta" accept="images/*, application/pdf"
                                        value="{{ asset('storage/' . $berkasPendukung->akta_kelahiran_file) }}">
                                    @error('akta')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @else
                                    <input type="file" class="form-control @error('akta') is-invalid @enderror"
                                        accept="images/*, application/pdf" name="akta" required>
                                    @error('akta')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($ppdbUser->jalur_pendaftaran == 'kepemimpinan')
                        <div class="form-group mt-3">
                            <label>{{ strtoupper($ppdbUser->jalur_pendaftaran) }}</label>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label for="sk_ketua_osis">Surat Keterangan Ketua Osis</label>
                                    @if ($berkasPendukung && $berkasPendukung->sk_ketua_osis)
                                        <a href="{{ asset('storage/' . $berkasPendukung->sk_ketua_osis) }}" target="_blank"
                                            class="btn btn-info">
                                            <i class="fas fa-file-alt"></i> Lihat File
                                        </a>
                                        <input id="sk_ketua_osis" type="file"
                                            class="form-control mt-2 @error('sk_ketua_osis') is-invalid @enderror"
                                            name="sk_ketua_osis" accept="images/*, application/pdf"
                                            value="{{ asset('storage/' . $berkasPendukung->sk_ketua_osis) }}">
                                        @error('sk_ketua_osis')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @else
                                        <input id="sk_ketua_osis" type="file"
                                            placeholder="Surat Keterangan Ketua OSIS/OSIM"
                                            accept="images/*, application/pdf"
                                            class="form-control @error('sk_ketua_osis') is-invalid @enderror"
                                            name="sk_ketua_osis" required>
                                        @error('sk_ketua_osis')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label for="penandatangan_sk">Penandatangan Surat Keterangan</label>
                                    <input type="text" id="penandatangan_sk" name="penandatangan_sk"
                                        placeholder="Penandatangan Surat Keterangan" required
                                        class="form-control @error('penandatangan_sk')
                                        is-invalid
                                    @enderror"
                                        value="{{ old('penandatangan_sk', $berkasPendukung->penandatangan_sk ?? '') }}">
                                    @error('penandatangan_sk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="periode">Periode Ketua Osis</label>
                                    <input type="text" id="periode" name="periode" placeholder="Periode" required
                                        class="form-control @error('periode')
                                        is-invalid
                                    @enderror"
                                        value="{{ old('periode', $berkasPendukung->periode ?? '') }}">
                                    @error('periode')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($ppdbUser->jalur_pendaftaran == 'prestasi')
                        <!-- Container Sertifikat -->
                        <div class="form-group mt-3">
                            <label>Sertifikat Tambahan<span class="text-danger">*</span></label>
                            <div id="sertifikat-container">
                                @foreach ($sertifikat as $key => $s)
                                    <div class="sertifikat-item border p-3 mb-3">
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>File Sertifikat</label><br>
                                                @if ($s->file_path)
                                                    <a href="{{ asset('storage/' . $s->file_path) }}" target="_blank"
                                                        class="btn btn-info btn-sm">
                                                        <i class="fas fa-file-alt"></i> Lihat File
                                                    </a>
                                                    <input type="file"
                                                        class="form-control mt-2 @error('sertifikat.' . $key) is-invalid @enderror"
                                                        name="sertifikat[]" accept="images/*, application/pdf">
                                                @else
                                                    <input type="file"
                                                        class="form-control @error('sertifikat.' . $key) is-invalid @enderror"
                                                        name="sertifikat[]" accept="images/*, application/pdf" required>
                                                @endif
                                                @error('sertifikat.' . $key)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Nama Sertifikat</label>
                                                <input type="text"
                                                    class="form-control @error('nama_sertifikat.' . $key) is-invalid @enderror"
                                                    name="nama_sertifikat[]" placeholder="Nama Sertifikat"
                                                    value="{{ old('nama_sertifikat.' . $key, $s->nama_sertifikat) }}"
                                                    required>
                                                @error('nama_sertifikat.' . $key)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Penandatangan Sertifikat</label>
                                                <input type="text"
                                                    class="form-control @error('penandatangan_sertifikat.' . $key) is-invalid @enderror"
                                                    name="penandatangan_sertifikat[]"
                                                    placeholder="Penandatangan Sertifikat"
                                                    value="{{ old('penandatangan_sertifikat.' . $key, $s->penandatangan_sertifikat) }}"
                                                    required>
                                                @error('penandatangan_sertifikat.' . $key)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Jenis Sertifikat</label>
                                                <select
                                                    class="form-control @error('jenis_sertifikat.' . $key) is-invalid @enderror"
                                                    name="jenis_sertifikat[]" required>
                                                    <option value="">Pilih Jenis Sertifikat</option>
                                                    <option value="akademik"
                                                        {{ old('jenis_sertifikat.' . $key, $s->jenis_sertifikat) == 'akademik' ? 'selected' : '' }}>
                                                        Akademik</option>
                                                    <option value="non akademik"
                                                        {{ old('jenis_sertifikat.' . $key, $s->jenis_sertifikat) == 'non akademik' ? 'selected' : '' }}>
                                                        Non Akademik</option>
                                                </select>
                                                @error('jenis_sertifikat.' . $key)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Tanggal Dikeluarkan</label>
                                                <input type="date"
                                                    class="form-control @error('tanggal_dikeluarkan.' . $key) is-invalid @enderror"
                                                    name="tanggal_dikeluarkan[]"
                                                    value="{{ old('tanggal_dikeluarkan.' . $key, $s->tanggal_dikeluarkan) }}"
                                                    required>
                                                @error('tanggal_dikeluarkan.' . $key)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label>Juara</label>
                                                <select class="form-control @error('juara.' . $key) is-invalid @enderror"
                                                    name="juara[]" required>
                                                    <option value="">Pilih Juara</option>
                                                    <option value="juara 1"
                                                        {{ old('juara.' . $key, $s->juara) == 'juara 1' ? 'selected' : '' }}>
                                                        Juara 1</option>
                                                    <option value="juara 2"
                                                        {{ old('juara.' . $key, $s->juara) == 'juara 2' ? 'selected' : '' }}>
                                                        Juara 2</option>
                                                    <option value="juara 3"
                                                        {{ old('juara.' . $key, $s->juara) == 'juara 3' ? 'selected' : '' }}>
                                                        Juara 3</option>
                                                    <option value="tidak ada kejuaraan"
                                                        {{ old('juara.' . $key, $s->juara) == 'tidak ada kejuaraan' ? 'selected' : '' }}>
                                                        Tidak Ada Kejuaraan</option>
                                                </select>
                                                @error('juara.' . $key)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6">
                                                <label>Tingkat Kejuaraan</label>
                                                <select
                                                    class="form-control @error('tingkat_kejuaraan.' . $key) is-invalid @enderror"
                                                    name="tingkat_kejuaraan[]" required>
                                                    <option value="">Pilih Tingkat Kejuaraan</option>
                                                    <option value="kabupaten"
                                                        {{ old('tingkat_kejuaraan.' . $key, $s->tingkat_kejuaraan) == 'kabupaten' ? 'selected' : '' }}>
                                                        Kabupaten</option>
                                                    <option value="kota"
                                                        {{ old('tingkat_kejuaraan.' . $key, $s->tingkat_kejuaraan) == 'kota' ? 'selected' : '' }}>
                                                        Kota</option>
                                                    <option value="provinsi"
                                                        {{ old('tingkat_kejuaraan.' . $key, $s->tingkat_kejuaraan) == 'provinsi' ? 'selected' : '' }}>
                                                        Provinsi</option>
                                                    <option value="nasional"
                                                        {{ old('tingkat_kejuaraan.' . $key, $s->tingkat_kejuaraan) == 'nasional' ? 'selected' : '' }}>
                                                        Nasional</option>
                                                    <option value="internasional"
                                                        {{ old('tingkat_kejuaraan.' . $key, $s->tingkat_kejuaraan) == 'internasional' ? 'selected' : '' }}>
                                                        Internasional</option>
                                                </select>
                                                @error('tingkat_kejuaraan.' . $key)
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success" onclick="addSertifikat()">Tambah
                                Sertifikat</button>
                            <button type="button" class="btn btn-danger" onclick="removeSertifikat(this)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                        @if ($ppdbUser->jalur_pendaftaran == 'prestasi' && count($sertifikat) == 0)
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    addSertifikat();
                                });
                            </script>
                        @endif

                        <script>
                            function addSertifikat() {
                                var container = document.getElementById('sertifikat-container');
                                var newInput = document.createElement('div');
                                newInput.classList.add('sertifikat-item', 'border', 'p-3', 'mb-3');
                                newInput.innerHTML = `
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label>Sertifikat Lainnya</label>
                                        <input type="file" class="form-control @error('sertifikat.*') is-invalid @enderror" accept="images/*, application/pdf" name="sertifikat[]" required>
                                        @error('sertifikat.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nama Sertifikat</label>
                                        <input type="text" class="form-control @error('nama_sertifikat.*') is-invalid @enderror" name="nama_sertifikat[]" placeholder="Nama Sertifikat" required>
                                        @error('nama_sertifikat.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label>Penandatangan Sertifikat</label>
                                        <input type="text" class="form-control @error('penandatangan_sertifikat.*') is-invalid @enderror" name="penandatangan_sertifikat[]" placeholder="Penandatangan Sertifikat" required>
                                        @error('penandatangan_sertifikat.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Jenis Sertifikat</label>
                                        <select class="form-control @error('jenis_sertifikat.*') is-invalid @enderror" name="jenis_sertifikat[]" required>
                                            <option value="">Pilih Jenis Sertifikat</option>
                                            <option value="akademik">Akademik</option>
                                            <option value="non akademik">Non Akademik</option>
                                        </select>
                                        @error('jenis_sertifikat.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label>Tanggal Dikeluarkan</label>
                                        <input type="date" class="form-control @error('tanggal_dikeluarkan.*') is-invalid @enderror" name="tanggal_dikeluarkan[]" required>
                                        @error('tanggal_dikeluarkan.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                    <label>Juara</label>
                                    <select class="form-control @error('juara.*') is-invalid @enderror" name="juara[]" required>
                                        <option value="">Pilih Juara</option>
                                        <option value="juara 1">Juara 1</option>
                                        <option value="juara 2">Juara 2</option>
                                        <option value="juara 3">Juara 3</option>
                                        <option value="tidak ada kejuaraan">Tidak Ada Kejuaraan</option>
                                    </select>
                                    @error('juara.*')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label>Tingkat Kejuaraan</label>
                                        <select class="form-control select2 @error('tingkat_kejuaraan.*') is-invalid @enderror"
                                        name="tingkat_kejuaraan[]" required>
                                            <option value="">Pilih Tingkat Kejuaraan</option>
                                            <option value="kabupaten">Kabupaten</option>
                                            <option value="kota">Kota</option>
                                            <option value="provinsi">Provinsi</option>
                                            <option value="nasional">Nasional</option>
                                            <option value="internasional">Internasional</option>
                                        </select>
                                        @error('tingkat_kejuaraan.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            `;
                                container.appendChild(newInput);
                            }

                            function removeSertifikat() {
                                var container = document.getElementById('sertifikat-container');
                                var items = container.getElementsByClassName('sertifikat-item');
                                console.log(items.length);
                                if (items.length > 1) {
                                    container.removeChild(items[items.length - 1]);
                                } else {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Oops...',
                                        text: 'Minimal harus ada satu sertifikat.'
                                    });
                                }
                            }
                        </script>
                    @endif
                    <!-- Tombol Navigasi -->

                    <a href="{{ route('ppdb.formulir.rapor') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Upload & Lanjut</button>
                @endif
            </form>
        </div>
    </div>
@endsection
