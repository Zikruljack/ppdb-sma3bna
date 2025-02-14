@extends('ppdb.dashboard.formulir')

@section('form-content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('ppdb.formulir.berkas.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kartu Keluarga (KK)</label>
                            <input type="file" class="form-control" name="kk" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal KK Dikeluarkan</label>
                            <input type="date" class="form-control" name="tanggal_kk_dikeluarkan" required>
                        </div>

                        <div class="form-group">
                            <label>KTP/KIA</label>
                            <input type="file" class="form-control" name="ktp_kia" required>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Surat Keterangan Aktif Sekolah</label>
                            <input type="file" class="form-control" name="surat_keterangan_aktif" required>
                        </div>

                        <div class="form-group">
                            <label>Akta Kelahiran</label>
                            <input type="file" class="form-control" name="akta" required>
                        </div>
                    </div>
                </div>

                <!-- Container Sertifikat -->
                <div class="form-group mt-3">
                    <label>Sertifikat (Opsional)</label>
                    <div id="sertifikat-container">
                        <input type="file" class="form-control mb-2" name="sertifikat[]">
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
