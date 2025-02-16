<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 16px;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 14px;
        }

        .table td,
        .table th {
            padding: 5px;
            text-align: left;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid black;
        }

        .signature {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
        }

        .signature p {
            display: inline-block;
            width: 48%;
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .biodata-container {
            display: table;
            width: 100%;
        }

        .biodata-row {
            display: table-row;
        }

        .biodata-cell {
            display: table-cell;
            vertical-align: top;
            padding: 5px;
            font-size: 12px;
        }

        .foto-container img {
            width: 120px;
            height: auto;
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="font-size: 21px;">FORMULIR PENDAFTARAN ONLINE SPMB 2025 / 2026</h2>
            <h3 style="font-size: 18px;">SMA NEGERI 3 BANDA ACEH</h3>
        </div>

        <div class="content">
            <p class="bold">Nomor Registrasi: {{ $ppdbUser->nomor_peserta }}</p>
            <p class="bold">Jalur Tes: {{ ucfirst($ppdbUser->jalur_pendaftaran) }}</p>
        </div>

        <div class="biodata-container">
            <div class="biodata-row">
                <div class="biodata-cell">
                    <table class="table">
                        <tr>
                            <td class="bold">Nama Calon Peserta Didik</td>
                            <td>{{ $ppdbUser->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <td class="bold">NIK</td>
                            <td>{{ $ppdbUser->nik }}</td>
                        </tr>
                        <tr>
                            <td class="bold">NISN</td>
                            <td>{{ $ppdbUser->nisn }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Jenis Kelamin</td>
                            <td>{{ $ppdbUser->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Tempat, Tanggal Lahir</td>
                            <td>{{ $ppdbUser->tempat_lahir }}, {{ $ppdbUser->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Alamat</td>
                            <td>{{ $ppdbUser->alamat }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Kabupaten / Kota</td>
                            <td>{{ $ppdbUser->kabupaten_kota }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Provinsi</td>
                            <td>{{ $ppdbUser->provinsi }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Golongan Darah</td>
                            <td>{{ $ppdbUser->gol_darah }}</td>
                        </tr>
                        <tr>
                            <td class="bold">Tinggi Badan</td>
                            <td>{{ $ppdbUser->tinggi_badan }} cm</td>
                        </tr>
                        <tr>
                            <td class="bold">Berat Badan</td>
                            <td>{{ $ppdbUser->berat_badan }} kg</td>
                        </tr>
                    </table>
                </div>
                <div class="biodata-cell foto-container">
                    <img src="{{ public_path('storage/' . $ppdbUser->foto) }}" alt="Foto Peserta">
                </div>
            </div>
        </div>

        <h3 style="font-size: 14px;">Nilai Rapor</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Semester</th>
                    <th>PAI</th>
                    <th>Bahasa Indonesia</th>
                    <th>Bahasa Inggris</th>
                    <th>Matematika</th>
                    <th>IPA</th>
                    <th>IPS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiRapor as $semester => $nilaiSemester)
                    <tr>
                        <td>{{ $semester }}</td>
                        <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'PAI')->nilai ?? '-' }}</td>
                        <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Bahasa Indonesia')->nilai ?? '-' }}</td>
                        <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Bahasa Inggris')->nilai ?? '-' }}</td>
                        <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'Matematika')->nilai ?? '-' }}</td>
                        <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'IPA')->nilai ?? '-' }}</td>
                        <td>{{ $nilaiSemester->firstWhere('mapel.mapel', 'IPS')->nilai ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="signature" style="text-align: right;">
            <p>Banda Aceh, {{ now()->locale('id')->translatedFormat('d F Y') }}</p>
            <br>
            <p><strong>Calon Murid,</strong></p>
            <br><br><br><br>
            <p>( {{ $ppdbUser->nama_lengkap }} )</p>
        </div>
    </div>

</body>

</html>
