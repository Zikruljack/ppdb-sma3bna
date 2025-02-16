@extends('adminlte::page')

@section('title', 'PPDB Settings')

@section('content_header')
    <h1>Pengaturan PPDB</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Jalur Pendaftaran</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Jalur</th>
                        <th>Tanggal Pembukaan</th>
                        <th>Waktu Pembukaan</th>
                        <th>Tanggal Penutupan</th>
                        <th>Waktu Penutupan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($settings as $setting)
                        <tr>
                            <td>{{ $setting->jalur_pendaftaran }}</td>
                            <td>{{ $setting->mulai_pendaftaran }}</td>
                            <td>{{ $setting->waktu_pembukaan_ppdb }}</td>
                            <td>{{ $setting->akhir_pendaftaran }}</td>
                            <td>{{ $setting->waktu_tutup_ppdb }}</td>
                            <td>
                                <span class="badge badge-{{ $setting->status ? 'success' : 'danger' }}">
                                    {{ $setting->status ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#info">Informasi Umum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#jadwal">Jadwal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#pengumuman">Pengumuman & Status</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.ppdb.setting.save') }}" method="POST">
                @csrf
                <div class="tab-content">
                    <!-- Tab 1: Informasi Umum -->
                    <div class="tab-pane fade show active" id="info">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select name="tahun" class="form-control" onchange="this.form.submit()">
                                        @foreach (range(date('Y'), date('Y') + 5) as $y)
                                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                                {{ $y }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jalur Pendaftaran</label>
                                    <input type="text" name="jalur_pendaftaran" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kuota</label>
                                    <input type="number" name="kuota" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 2: Jadwal -->
                    <div class="tab-pane fade" id="jadwal">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Mulai Pendaftaran</label>
                                    <input type="date" name="mulai_pendaftaran" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Waktu Pembukaan</label>
                                    <input type="time" name="waktu_pembukaan" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Akhir Pendaftaran</label>
                                    <input type="date" name="akhir_pendaftaran" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Waktu Penutupan</label>
                                    <input type="time" name="waktu_penutupan" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab 3: Pengumuman & Status -->
                    <div class="tab-pane fade" id="pengumuman">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pengumuman</label>
                                    <input type="date" name="tanggal_pengumuman" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Aktif</option>
                                        <option value="0">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@endsection
