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
                                <input type="file" class="form-control @error('kk') is-invalid @enderror" name="kk"
                                    accept="images/*, application/pdf">
                                @error('kk')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Surat Keterangan Aktif Sekolah <span class="text-danger">*</span></label>
                                <input type="file"
                                    class="form-control @error('surat_keterangan_aktif') is-invalid @enderror"
                                    accept="images/*, application/pdf" name="surat_keterangan_aktif">
                                @error('surat_keterangan_aktif')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Akta Kelahiran <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('akta') is-invalid @enderror"
                                    accept="images/*, application/pdf" name="akta">
                                @error('akta')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @if ($ppdbUser->jalur_pendaftaran == 'kepemimpinan')
                        <div class="form-group mt-3">
                            <label>{{ strtoupper($ppdbUser->jalur_pendaftaran) }}</label>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label for="sk_ketua_osis">Surat Keterangan Ketua Osis</label>
                                    <input id="sk_ketua_osis" type="file" placeholder="Surat Keterangan Ketua OSIS/OSIM"
                                        accept="images/*, application/pdf"
                                        class="form-control @error('sk_ketua_osis') is-invalid @enderror"
                                        name="sk_ketua_osis">
                                    @error('sk_ketua_osis')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="sk_ketua_osis">Penandatangan Surat Keterangan</label>
                                    <input type="text" id="penandatangan_sk" name="penandatangan_sk"
                                        placeholder="Penandatangan Surat Keterangan"
                                        class="form-control @error('penandatangan_sk')
                                        is-invalid
                                    @enderror">
                                    @error('penandatangan_sk')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="periode">Periode Ketua Osis</label>
                                    <input type="text" id="periode" name="periode" placeholder="Periode"
                                        class="form-control @error('periode')
                                        is-invalid
                                    @enderror">
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

                            <label>Sertifikat {{ strtoupper($ppdbUser->jalur_pendaftaran) }} <span
                                    class="text-danger">*</span></label>
                            <div id="sertifikat-container">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label>Sertifikat</label>
                                        <input type="file"
                                            class="form-control @error('sertifikat.*') is-invalid @enderror"
                                            accept="images/*, application/pdf" name="sertifikat[]">
                                        @error('sertifikat.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nama Sertifikat</label>
                                        <input type="text"
                                            class="form-control @error('nama_sertifikat.*') is-invalid @enderror"
                                            name="nama_sertifikat[]" placeholder="Nama Sertifikat">
                                        @error('nama_sertifikat.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <label>Penandatangan Sertifikat</label>
                                        <input type="text"
                                            class="form-control @error('penandatangan_sertifikat.*') is-invalid @enderror"
                                            name="penandatangan_sertifikat[]" placeholder="Penandatangan Sertifikat">
                                        @error('penandatangan_sertifikat.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Jenis Sertifikat</label>
                                        <select
                                            class="form-control select2 @error('jenis_sertifikat.*') is-invalid @enderror"
                                            name="jenis_sertifikat[]">
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
                                        <input type="date"
                                            class="form-control @error('tanggal_dikeluarkan.*') is-invalid @enderror"
                                            name="tanggal_dikeluarkan[]">
                                        @error('tanggal_dikeluarkan.*')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label>Juara</label>
                                        <select class="form-control @error('juara.*') is-invalid @enderror"
                                            name="juara[]">
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
                                        <select
                                            class="form-control select2 @error('tingkat_kejuaraan.*') is-invalid @enderror"
                                            name="tingkat_kejuaraan[]">
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
                            </div>
                            <button type="button" class="btn btn-success btn-sm mt-2" onclick="addSertifikat()">
                                <i class="fas fa-plus"></i> Tambah Sertifikat
                            </button>
                        </div>

                        <script>
                            function addSertifikat() {
                                var container = document.getElementById('sertifikat-container');
                                var newInput = document.createElement('div');
                                newInput.innerHTML = `
                                <hr>
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
                                            <option value="Kabupaten">Kabupaten</option>
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
