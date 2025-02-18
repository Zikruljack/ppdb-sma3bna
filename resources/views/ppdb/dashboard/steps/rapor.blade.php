@extends('ppdb.dashboard.formulir')

@section('title', 'Isi Rapor')


@section('form-content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Isi Rapor Jalur {{ strtoupper($ppdbUser->jalur_pendaftaran) }}</h5>
        </div>

        <div class="card-body">
            @if (empty($ppdbUser->nisn))
                <div class="alert alert-danger" role="alert">
                    <h5 class="alert-heading"> <i class="fas fa-exclamation-triangle"></i> Perhatian!</h5>
                    <p>
                        Anda belum mengisi melengkapi data diri. Silakan isi data diri terlebih dahulu untuk dapat mengisi
                        nilai rapor.
                    </p>
                </div>
            @else
                {{-- block info  --}}
                <div class="alert alert-warning" role="alert">
                    <h5 class="alert-heading"> <i class="fas fa-exclamation-triangle"></i> Perhatian!</h5>
                    <p>
                        Harap isi nilai rapor sesuai dengan yang tertera pada rapor asli dan pastikan nilai yang dimasukkan
                        sesuai dengan semester yang diinput.
                    </p>
                    <p>
                        Nilai minimal yang berlaku: <strong>Jalur Prestasi: 86 | Jalur Kepemimpinan: 82</strong>.
                    </p>
                    <p>
                        Untuk mata pelajaran Pendidikan Agama, silakan isi nilai sesuai dengan agama yang dianut oleh siswa.
                    </p>
                </div>

                <form action="{{ route('ppdb.formulir.rapor.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($ppdbUser->status == 'Final')
                        <div class="alert alert-warning">
                            Data tidak bisa diubah karena status sudah final.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="fixed-width">Semester</th>
                                        @foreach ($mapel as $mpls)
                                            <th class="fixed-width">{{ $mpls->mapel }}</th>
                                        @endforeach
                                        <th class="fixed-width">Scan Rapor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($semester = 3; $semester <= 5; $semester++)
                                        <tr>
                                            <td>Semester {{ $semester }}</td>
                                            @foreach ($mapel as $mpl)
                                                <td>
                                                    <input type="text" class="form-control nilai-rapor"
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
                                                    name="scan_rapor[{{ $semester }}]" accept="application/pdf,image/*">

                                                @error("scan_rapor.$semester")
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>


                        <a href="{{ route('ppdb.pendaftaran') }}" class="btn btn-secondary"
                            onclick="stepper.previous()">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan & Lanjut</button>
                    @endif
                </form>
            @endif
        </div>
    </div>
@endsection
