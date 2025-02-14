<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Ujian</title>
    <style>
        /* @page {
            size: 10cm 14cm;
            margin: 10px;
        } */

        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            border: 1px solid #000;
            padding: 10px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .logo {
            width: 50px;
        }

        .table-info {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table-info td {
            padding: 5px;
            vertical-align: top;
        }

        .photo-signature {
            margin-top: 10px;
            text-align: center;
        }

        .student-photo {
            width: 100px;
            height: 120px;
            border: 1px solid #000;
            display: block;
            margin: 0 auto;
        }

        .signature {
            text-align: center;
            margin-top: 10px;
        }

        .signature p {
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('assets/img/logo_smantig.png') }}" class="logo" alt="Logo Sekolah">
            <h4>DINAS PENDIDIKAN</h4>
            <h4>SMA NEGERI 3 BANDA ACEH</h4>
        </div>

        <table class="table-info">
            <tr>
                <td><strong>No. Ujian</strong></td>
                <td>: {{ $data->nomor_ujian ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Nama Peserta</strong></td>
                <td>: {{ $data->nama_lengkap }}</td>
            </tr>
            <tr>
                <td><strong>NISN</strong></td>
                <td>: {{ $data->nisn }}</td>
            </tr>
            <tr>
                <td><strong>TTL</strong></td>
                <td>: {{ $data->tempat_lahir }}, {{ $data->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td><strong>Jenis Kelamin</strong></td>
                <td>: {{ $data->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td><strong>Asal Sekolah</strong></td>
                <td>: {{ $data->asal_sekolah }}</td>
            </tr>
        </table>

        <hr>

        <div class="photo-signature">
            <img src="{{ public_path('storage/' . $data->foto) }}" class="student-photo" alt="Foto Siswa">
            <div class="signature">
                <p>Ketua Panitia,</p>
                <span><strong>Nama Panitia</strong></span>
                <br>
                <small>NIP: 123456789</small>
            </div>
        </div>
    </div>
</body>

</html>
