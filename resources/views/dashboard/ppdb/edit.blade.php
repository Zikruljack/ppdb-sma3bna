@extends('adminlte::page')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Peserta</h5>
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#info">Data Diri</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#jadwal">Nilai Rapor</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.ppdb.peserta.update', $ppdbUser->id) }}" method="POST"
                            enctype="multipart/form-data">
                            <div class="tab-content">
                                <div class="tab-pane active" id="info">
                                </div>
                                <div class="tab-pane fade" id="jadwal">

                                    @csrf
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Semester</th>
                                                @foreach ($mapel as $mpls)
                                                    <th>{{ $mpls->mapel }}</th>
                                                @endforeach
                                                <th>Scan Rapor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($semester = 3; $semester <= 5; $semester++)
                                                <tr>
                                                    <td>Semester {{ $semester }}</td>
                                                    @foreach ($mapel as $mpl)
                                                        <td>
                                                            <input type="number" class="form-control nilai-rapor"
                                                                name="nilai[{{ $semester }}][{{ $mpl->id }}]"
                                                                max="100"
                                                                value="{{ old("nilai.$semester.$mpl->id", $nilaiRapors[$semester][$mpl->id] ?? '') }}"
                                                                oninput="validateNilai(this)">

                                                            @error("nilai.$semester.$mpl->id")
                                                                <small class="text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </td>
                                                    @endforeach

                                                    <td>
                                                        <input type="file" class="form-control"
                                                            name="scan_rapor[{{ $semester }}]"
                                                            accept="application/pdf,image/*">

                                                        @error("scan_rapor.$semester")
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>

                                    </table>

                                    <a href="{{ route('ppdb.pendaftaran') }}" class="btn btn-secondary"
                                        onclick="stepper.previous()">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Simpan & Lanjut</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
