@extends('ppdb.dashboard.formulir')

@section('form-content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Isi Rapor Jalur {{ strtoupper($ppdbUser->jalur_pendaftaran) }}</h5>
        </div>


        <div class="card-body">
            {{-- block info  --}}
            <div class="alert alert-warning" role="alert">
                <h5 class="alert-heading"> <i class="fas fa-exclamation-triangle"></i> Perhatian!</h5>
                <p>
                    Isi nilai rapor harus sesuai dengan yang tertera pada rapor asli.
                    Nilai yang diisi harus sesuai dengan semester yang diisi.
                    Minimal Nilai Untuk <strong>Jalur Prestasi 86, Jalur Kepemimpinan 82</strong>
                </p>
            </div>
            <form action="{{ route('ppdb.formulir.rapor.upload') }}" method="POST" enctype="multipart/form-data">
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
                                            name="nilai[{{ $semester }}][{{ $mpl->id }}]" max="100"
                                            value="{{ old("nilai.$semester.$mpl->id", $nilaiRapors[$semester][$mpl->id] ?? '') }}"
                                            oninput="validateNilai(this)">

                                        @error("nilai.$semester.$mpl->id")
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </td>
                                @endforeach

                                <td>
                                    <input type="file" class="form-control" name="scan_rapor[{{ $semester }}]"
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
            </form>
        </div>
    </div>
@endsection
