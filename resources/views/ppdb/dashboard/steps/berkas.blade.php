@extends('ppdb.dashboard.formulir')

@section('form-content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Upload Berkas Jalur {{ strtoupper($ppdbUser->jalur_pendaftaran) }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('ppdb.formulir.berkas.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('kk') is-invalid @enderror" name="kk"
                                required>
                            @error('kk')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Surat Keterangan Aktif Sekolah <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('surat_keterangan_aktif') is-invalid @enderror"
                                name="surat_keterangan_aktif" required>
                            @error('surat_keterangan_aktif')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Akta Kelahiran <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('akta') is-invalid @enderror" name="akta"
                                required>
                            @error('akta')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Container Sertifikat -->
                <div class="form-group mt-3">
                    <label>Sertifikat {{ strtoupper($ppdbUser->jalur_pendaftaran) }} <span
                            class="text-danger">*</span></label>
                    <div id="sertifikat-container">
                        <input type="file" class="form-control mb-2 @error('sertifikat.*') is-invalid @enderror"
                            name="sertifikat[]">
                        @error('sertifikat.*')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-success btn-sm mt-2" onclick="addSertifikat()">
                        <i class="fas fa-plus"></i> Tambah Sertifikat
                    </button>
                </div>

                <script>
                    function addSertifikat() {
                        var container = document.getElementById('sertifikat-container');
                        var newInput = document.createElement('div');
                        newInput.innerHTML =
                            '<input type="file" class="form-control mb-2" name="sertifikat[]">';
                        container.appendChild(newInput);
                    }
                </script>

                <!-- Tombol Navigasi -->

                <a href="{{ route('ppdb.formulir.rapor') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Upload & Lanjut</button>
            </form>
        </div>
    </div>
@endsection
