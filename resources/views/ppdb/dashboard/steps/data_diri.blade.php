@extends('ppdb.dashboard.formulir')
@section('title', 'Data Diri')
@section('form-content')
    <div class="card">
        <div class="card-body">
            <div class="alert alert-info">
                <h5 class="alert-heading">Note :</h5>
                <p>
                    File yang diupload harus berekstensi pdf,jpg,png dan max file 2mb.
                </p>
                <p>
                    Jika ada kosong datanya maka di isi dengan <strong>"-". </strong>
                </p>
            </div>
            <form id="dataDiriForm" action="{{ route('ppdb.formulir.data_diri') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($ppdbUser->status == 'Final')
                    <div class="alert alert-warning">
                        Data tidak bisa diubah karena status sudah final.
                    </div>
                @else
                    <div class="mb-3">
                        <p class="text-muted">

                            <label for="jalur_pendaftaran" class="form-label">Jalur Pendaftaran</label>

                            <select class="form-control select2" name="jalur_pendaftaran" id="jalur_pendaftaran">
                                <option value="">Pilih</option>
                                <option value="prestasi"
                                    {{ old('jalur_pendaftaran', $ppdbUser->jalur_pendaftaran) == 'prestasi' ? 'selected' : '' }}>
                                    Prestasi
                                </option>
                                <option value="kepemimpinan"
                                    {{ old('jalur_pendaftaran', $ppdbUser->jalur_pendaftaran) == 'kepemimpinan' ? 'selected' : '' }}>
                                    Kepemimpinan
                                </option>
                            </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                    value="{{ old('nama_lengkap', $ppdbUser->nama_lengkap) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="number" class="form-control" id="nisn" name="nisn"
                                    value="{{ old('nisn', $ppdbUser->nisn) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="number" class="form-control" id="nik" name="nik"
                                    value="{{ old('nik', $ppdbUser->nik) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_kk" class="form-label">No. KK</label>
                                <input type="number" class="form-control" id="no_kk" name="no_kk"
                                    value="{{ old('no_kk', $ppdbUser->no_kk) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto" accept="image/*"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_kk_dikeluarkan" class="form-label">Tanggal KK Dikeluarkan</label>
                                <input type="date" class="form-control" id="tanggal_kk_dikeluarkan"
                                    name="tanggal_kk_dikeluarkan"
                                    value="{{ old('tanggal_kk_dikeluarkan', $ppdbUser->tanggal_kk_dikeluarkan) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    value="{{ old('tempat_lahir', $ppdbUser->tempat_lahir) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $ppdbUser->tanggal_lahir) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control select2" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin', $ppdbUser->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki
                                    </option>
                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin', $ppdbUser->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="agama" class="form-label">Agama</label>
                                <select name="agama" id="agama" class="form-control select2">
                                    <option value="">Pilih</option>
                                    <option value="islam"
                                        {{ old('agama', $ppdbUser->agama) == 'islam' ? 'selected' : '' }}>
                                        Islam
                                    </option>
                                    <option value="kristen"
                                        {{ old('agama', $ppdbUser->agama) == 'kristen' ? 'selected' : '' }}>
                                        Kristen
                                    </option>
                                    <option value="katolik"
                                        {{ old('agama', $ppdbUser->agama) == 'katolik' ? 'selected' : '' }}>
                                        Katolik
                                    </option>
                                    <option value="hindu"
                                        {{ old('agama', $ppdbUser->agama) == 'hindu' ? 'selected' : '' }}>
                                        Hindu
                                    </option>
                                    <option value="budha"
                                        {{ old('agama', $ppdbUser->agama) == 'budha' ? 'selected' : '' }}>
                                        Budha
                                    </option>
                                    <option value="konghucu"
                                        {{ old('agama', $ppdbUser->agama) == 'konghucu' ? 'selected' : '' }}>
                                        Konghucu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="gol_darah" class="form-label">Golongan Darah</label>
                                <select class="form-control select2" id="gol_darah" name="gol_darah" required>
                                    <option value="">Pilih</option>
                                    <option value="O"
                                        {{ old('gol_darah', $ppdbUser->gol_darah) == 'O' ? 'selected' : '' }}>O</option>
                                    <option value="A"
                                        {{ old('gol_darah', $ppdbUser->gol_darah) == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B"
                                        {{ old('gol_darah', $ppdbUser->gol_darah) == 'B' ? 'selected' : '' }}>B</option>
                                    <option value="AB"
                                        {{ old('gol_darah', $ppdbUser->gol_darah) == 'AB' ? 'selected' : '' }}>AB</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan"
                                    value="{{ old('tinggi_badan', $ppdbUser->tinggi_badan) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                <input type="number" class="form-control" id="berat_badan" name="berat_badan"
                                    value="{{ old('berat_badan', $ppdbUser->berat_badan) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                    value="{{ old('no_hp', $ppdbUser->no_hp) }}" required>
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4">Data Tempat Tinggal</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <select class="form-control select2" name="provinsi" id="provinsi">
                                    <option value="">Pilih</option>
                                    @foreach ($wilayahProvinsi as $provinsi)
                                        <option value="{{ $provinsi->code }}"
                                            {{ old('provinsi', $ppdbUser->provinsi) == $provinsi->code ? 'selected' : '' }}>
                                            {{ $provinsi->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="kabupaten_kota" class="form-label">Kabupaten/Kota</label>
                                <select class="form-control select2" name="kabupaten_kota" id="kabupaten_kota">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <select class="form-control select2" name="kecamatan" id="kecamatan">
                                    <option value="">Pilih</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kode_pos" class="form-label">KodePos</label>
                                <input type="text" class="form-control" name="kode_pos" id="kode_pos"
                                    value="{{ old('kode_pos', $ppdbUser->kode_pos) }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat', $ppdbUser->alamat) }}</textarea>
                        </div>
                    </div>

                    <h4 class="mt-4">Data Sekolah Asal</h4>
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="mb-3">
                                <label for="asal_sekolah" class="form-label">Sekolah Asal</label>
                                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah"
                                    value="{{ old('asal_sekolah', $ppdbUser->asal_sekolah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="npsn_asal_sekolah" class="form-label">NPSN Asal Sekolah</label>
                                <input type="text" class="form-control" id="npsn_asal_sekolah"
                                    name="npsn_asal_sekolah"
                                    value="{{ old('npsn_asal_sekolah', $ppdbUser->npsn_asal_sekolah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="kabkota_asal_sekolah" class="form-label">Kota Asal Sekolah</label>
                                <input type="text" class="form-control" id="kabkota_asal_sekolah"
                                    name="kabkota_asal_sekolah"
                                    value="{{ old('kabkota_asal_sekolah', $ppdbUser->kabkota_asal_sekolah) }}" required>
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-4">Data Orang Tua</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                    value="{{ old('nama_ayah', $ppdbUser->nama_ayah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                                <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah"
                                    value="{{ old('pekerjaan_ayah', $ppdbUser->pekerjaan_ayah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan_ayah" class="form-label">Jabatan Ayah</label>
                                <input type="text" class="form-control" id="jabatan_ayah" name="jabatan_ayah"
                                    value="{{ old('jabatan_ayah', $ppdbUser->jabatan_ayah) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp_ayah" class="form-label">No HP Ayah</label>
                                <input type="text" class="form-control" id="no_hp_ayah" name="no_hp_ayah"
                                    value="{{ old('no_hp_ayah', $ppdbUser->no_hp_ayah) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                    value="{{ old('nama_ibu', $ppdbUser->nama_ibu) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                                <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu"
                                    value="{{ old('pekerjaan_ibu', $ppdbUser->pekerjaan_ibu) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jabatan_ibu" class="form-label">Jabatan Ibu</label>
                                <input type="text" class="form-control" id="jabatan_ibu" name="jabatan_ibu"
                                    value="{{ old('jabatan_ibu', $ppdbUser->jabatan_ibu) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_hp_ibu" class="form-label">No HP Ibu</label>
                                <input type="text" class="form-control" id="no_hp_ibu" name="no_hp_ibu"
                                    value="{{ old('no_hp_ibu', $ppdbUser->no_hp_ibu) }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="alamat_ortu" class="form-label">Alamat Orang Tua</label>
                            <textarea name="alamat_ortu" class="form-control" id="alamat_ortu">{{ old('alamat_ortu', $ppdbUser->alamat_ortu) }}</textarea>
                        </div>
                    </div>

                    <button type="submit" id="btn-lanjut" class="btn btn-primary">Simpan &
                        Lanjut</button>
                @endif
            </form>
        </div>
    </div>
@endsection


@section('js-form')
    <script>
        $(document).ready(function() {
            var oldProvinsi = "{{ old('provinsi', $ppdbUser->provinsi) }}";
            var oldKabupaten = "{{ old('kabupaten_kota', $ppdbUser->kabupaten_kota) }}";
            var oldKecamatan = "{{ old('kecamatan', $ppdbUser->kecamatan) }}";

            // Ketika provinsi berubah
            $('#provinsi').change(function() {
                var province_id = $(this).val();
                $('#kabupaten_kota').html('<option value="">Loading...</option>');
                $('#kecamatan').html('<option value="">Pilih</option>');

                if (province_id) {
                    $.ajax({
                        url: '/get-kabupaten',
                        type: 'GET',
                        data: {
                            province_id: province_id
                        },
                        success: function(data) {
                            var options = '<option value="">Pilih</option>';
                            $.each(data, function(key, value) {
                                var selected = (value.id == oldKabupaten) ? 'selected' :
                                    '';
                                options += '<option value="' + value.code + '" ' +
                                    selected + '>' + value.name + '</option>';
                            });
                            $('#kabupaten_kota').html(options);

                            // Jika ada old value kabupaten, trigger change untuk memuat kecamatan
                            if (oldKabupaten) {
                                $('#kabupaten_kota').trigger('change');
                            }
                        }
                    });
                }
            });

            // Ketika kabupaten berubah
            $('#kabupaten_kota').change(function() {
                var city_id = $(this).val();
                $('#kecamatan').html('<option value="">Loading...</option>');

                if (city_id) {
                    $.ajax({
                        url: '/get-kecamatan',
                        type: 'GET',
                        data: {
                            city_id: city_id
                        },
                        success: function(data) {
                            var options = '<option value="">Pilih</option>';
                            $.each(data, function(key, value) {
                                var selected = (value.id == oldKecamatan) ? 'selected' :
                                    '';
                                options += '<option value="' + value.code + '" ' +
                                    selected + '>' + value.name + '</option>';
                            });
                            $('#kecamatan').html(options);
                        }
                    });
                }
            });

            // Jika oldProvinsi ada, trigger change agar kabupaten dimuat
            if (oldProvinsi) {
                $('#provinsi').trigger('change');
            }
        });
    </script>
@endsection
