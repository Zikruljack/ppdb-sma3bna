@extends('ppdb.dashboard.formulir')


@section('form-content')
    <div class="container-fluid">
        <div class="card">
            <h2 class="text-center">FORMULIR PENDAFTARAN ONLINE PPDB 2024/2025</h2>
            <h3 class="text-center">SMA NEGERI 3 BANDA ACEH</h3>
            <hr>

            <table class="table table-bordered">
                <tr>
                    <th>Nomor Registrasi</th>
                    <td>{{ $ppdbUser->nomor_registrasi }}</td>
                </tr>
                <tr>
                    <th>Jalur Tes</th>
                    <td>{{ $ppdbUser->jalur_pendaftaran }}</td>
                </tr>
                <tr>
                    <th>Nama Calon Peserta Didik</th>
                    <td>{{ $ppdbUser->name }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $ppdbUser->nik }}</td>
                </tr>
                <tr>
                    <th>NISN</th>
                    <td>{{ $ppdbUser->nisn }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $ppdbUser->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>{{ $ppdbUser->tempat_lahir }}, {{ $ppdbUser->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $ppdbUser->alamat }}</td>
                </tr>
                <tr>
                    <th>Kabupaten/Kota</th>
                    <td>{{ $ppdbUser->kota }}</td>
                </tr>
                <tr>
                    <th>Provinsi</th>
                    <td>{{ $ppdbUser->provinsi }}</td>
                </tr>
                <tr>
                    <th>Golongan Darah</th>
                    <td>{{ $ppdbUser->golongan_darah }}</td>
                </tr>
                <tr>
                    <th>Tinggi Badan</th>
                    <td>{{ $ppdbUser->tinggi_badan }} cm</td>
                </tr>
                <tr>
                    <th>Berat Badan</th>
                    <td>{{ $ppdbUser->berat_badan }} kg</td>
                </tr>
                <tr>
                    <th>Nama Sekolah Asal</th>
                    <td>{{ $ppdbUser->nama_sekolah_asal }}</td>
                </tr>
                <tr>
                    <th>NPSN Sekolah</th>
                    <td>{{ $ppdbUser->npsn_sekolah }}</td>
                </tr>
                <tr>
                    <th>Kabupaten/Kota Sekolah Asal</th>
                    <td>{{ $ppdbUser->kota_sekolah }}</td>
                </tr>
                <tr>
                    <th>Nama Ayah</th>
                    <td>{{ $ppdbUser->nama_ayah }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan Ayah</th>
                    <td>{{ $ppdbUser->pekerjaan_ayah }}</td>
                </tr>
                <tr>
                    <th>Nama Ibu</th>
                    <td>{{ $ppdbUser->nama_ibu }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan Ibu</th>
                    <td>{{ $ppdbUser->pekerjaan_ibu }}</td>
                </tr>
                <tr>
                    <th>No. HP</th>
                    <td>{{ $ppdbUser->no_hp }}</td>
                </tr>
            </table>

            <h4>Nilai Rapor</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Semester</th>
                    <th>Agama</th>
                    <th>Bahasa Indonesia</th>
                    <th>Bahasa Inggris</th>
                    <th>Matematika</th>
                    <th>IPA</th>
                    <th>IPS</th>
                </tr>
                @foreach ($nilaiRapor as $semester => $nilai_semester)
                    @php
                        // Buat array kosong untuk nilai mata pelajaran
                        $mapelNilai = [
                            'Agama' => '',
                            'Bahasa Indonesia' => '',
                            'Bahasa Inggris' => '',
                            'Matematika' => '',
                            'IPA' => '',
                            'IPS' => '',
                        ];
                        // Isi array dengan nilai sesuai mapel yang ada di database
                        foreach ($nilai_semester as $nilai) {
                            $mapelNilai[$nilai->mapel->nama_mapel] = $nilai->nilai;
                        }
                    @endphp
                    <tr>
                        <td><strong>Semester {{ $semester }}</strong></td>
                        <td>{{ $mapelNilai['Agama'] }}</td>
                        <td>{{ $mapelNilai['Bahasa Indonesia'] }}</td>
                        <td>{{ $mapelNilai['Bahasa Inggris'] }}</td>
                        <td>{{ $mapelNilai['Matematika'] }}</td>
                        <td>{{ $mapelNilai['IPA'] }}</td>
                        <td>{{ $mapelNilai['IPS'] }}</td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>
@endsection
