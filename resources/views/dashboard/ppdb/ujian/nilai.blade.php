@extends('adminlte::page')

@section('title', 'Input Nilai')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs" id="nilaiTabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="wawancara-tab" data-toggle="tab" href="#wawancara">Nilai Wawancara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="quran-tab" data-toggle="tab" href="#quran">Nilai Baca Quran</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Tab Wawancara -->
                    <div class="tab-pane fade show active" id="wawancara">
                        <form id="form_wawancara">
                            @csrf
                            <div class="form-group">
                                <label for="search_peserta">Cari Nomor Peserta/Nomor Ujian</label>
                                <input type="text" id="search_peserta" class="form-control"
                                    placeholder="Masukkan nomor peserta/ujian"
                                    onkeyup="cariPeserta(this.value, 'data_diri')">
                            </div>
                            <div id="data_diri">
                                <!-- Data peserta akan muncul di sini -->
                            </div>
                            <div class="form-group">
                                <label for="bobot_wawancara">Nilai Wawancara</label>
                                <input type="number" name="bobot_wawancara" id="bobot_wawancara" class="form-control"
                                    required>
                            </div>
                            <input type="hidden" id="user_id_wawancara" name="user_id">
                            <input type="hidden" id="verifikator" name="verifikator" value="{{ auth()->user()->name }}">
                            <button type="button" class="btn btn-primary"
                                onclick="submitNilai('wawancara')">Simpan</button>
                        </form>
                    </div>

                    <!-- Tab Baca Quran -->
                    <div class="tab-pane fade" id="quran">
                        <form id="form_quran">
                            @csrf
                            <div class="form-group">
                                <label for="search_peserta_quran">Cari Nomor Peserta/Nomor Ujian</label>
                                <input type="text" id="search_peserta_quran" class="form-control"
                                    placeholder="Masukkan nomor peserta/ujian"
                                    onkeyup="cariPeserta(this.value, 'data_diri_quran')">
                            </div>
                            <div id="data_diri_quran">
                                <!-- Data peserta akan muncul di sini -->
                            </div>
                            <div class="form-group">
                                <label for="bobot_baca_quran">Nilai Baca Quran</label>
                                <input type="number" name="bobot_baca_quran" id="bobot_baca_quran" class="form-control"
                                    required>
                            </div>
                            <input type="hidden" id="user_id_quran" name="user_id">
                            <input type="hidden" id="verifikator" name="verifikator" value="{{ auth()->user()->name }}">
                            <button type="button" class="btn btn-primary" onclick="submitNilai('quran')">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cariPeserta(nomor, targetId) {
            if (nomor.length < 3) {
                document.getElementById(targetId).innerHTML = "";
                return;
            }

            fetch('/admin/ppdb/peserta/list/cari?nomor=' + nomor)
                .then(response => response.json())
                .then(data => {
                    if (data && !data.error) {
                        document.getElementById(targetId).innerHTML = `
                        <div class="alert alert-info">
                            <strong>Nama:</strong> ${data.nama_lengkap} <br>
                            <strong>Nomor Ujian:</strong> ${data.nomor_ujian} <br>
                            <strong>Jalur Pendaftaran:</strong> ${data.jalur_pendaftaran}
                        </div>
                    `;
                        // Set user_id pada input tersembunyi
                        if (targetId === 'data_diri') {
                            document.getElementById('user_id_wawancara').value = data.user_id;
                        } else {
                            document.getElementById('user_id_quran').value = data.user_id;
                        }
                    } else {
                        document.getElementById(targetId).innerHTML =
                            '<div class="alert alert-danger">Peserta tidak ditemukan</div>';
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function submitNilai(tipe) {
            let formId = tipe === 'wawancara' ? 'form_wawancara' : 'form_quran';
            let url = tipe === 'wawancara' ? '/admin/ppdb/peserta/input-nilai/wawancara/' :
                '/admin/ppdb/peserta/input-nilai/quran/';
            let userId = tipe === 'wawancara' ? document.getElementById('user_id_wawancara').value : document
                .getElementById('user_id_quran').value;

            if (!userId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: 'Harap cari peserta terlebih dahulu!',
                });
                return;
            }

            let formData = new FormData(document.getElementById(formId));

            fetch(url + userId, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan, silakan coba lagi!',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat mengirim data!',
                    });
                    console.error('Error:', error);
                });
        }
    </script>

@endsection
