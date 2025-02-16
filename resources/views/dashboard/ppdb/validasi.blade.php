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

                            <div class="form-group">
                                <label for="status">Status Validasi</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="valid">Valid</option>
                                    <option value="tidak_valid">Tidak Valid</option>
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
        document.getElementById('validateButton').addEventListener('click', function() {
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
                    document.getElementById('validateForm').submit();
                }
            })
        });
    </script>
@endsection
