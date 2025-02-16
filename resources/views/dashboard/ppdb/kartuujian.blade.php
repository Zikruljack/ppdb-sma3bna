<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Ujian</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 20px;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .kartu {
            width: 14cm;
            height: 12cm;
            border: 2px solid black;
            padding: 10px;
            margin: 0 auto;
            /* Center the card */
        }

        /* Header */
        .header {
            text-align: center;
            border-bottom: 2px solid black;
            padding-bottom: 5px;
            position: relative;
        }

        .logo {
            width: 60px;
            height: 60px;
            position: absolute;
            left: 10px;
            top: 5px;
        }

        .header-text {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        /* Content */
        .content {
            font-size: 16px;
            /* Diperbesar 30% dari ukuran default 12px */
            line-height: 1.6;
        }

        .content-table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-table td {
            padding: 5px 0;
            vertical-align: top;
        }

        .content-table .label {
            font-weight: bold;
            width: 40%;
        }

        .content-table .value {
            width: 60%;
            text-align: left;
        }

        /* Footer */
        .footer {
            margin-top: 10px;
            display: table;
            width: 100%;
        }

        .photo {
            display: table-cell;
            width: 35%;
            text-align: center;
            vertical-align: top;
        }

        .student-photo {
            width: 90px;
            height: 120px;
            border: 1px solid black;
            display: block;
            margin: 0 auto;
        }

        .signature {
            display: table-cell;
            width: 65%;
            text-align: center;
            vertical-align: bottom;
        }

        .signature p {
            margin-bottom: 40px;
        }

        /* Divider */
        /* Divider */
        .divider {
            width: 100%;
            text-align: center;
            margin: 20px 0;
            border-top: 2px dashed black;
            position: relative;
            height: 25px;
            /* Tambahkan tinggi agar teks tidak bertabrakan */
        }

        .divider-text {
            position: absolute;
            font-size: 8px;
            color: gray;
            background: white;
            /* Supaya teks tidak tertutup garis */
            padding: 2px 5px;
        }

        /* Posisi teks atas & bawah */
        .divider-text.top {
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
        }

        .divider-text.bottom {
            bottom: -9px;
            top: 2px;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body>
    <!-- Kartu Ujian Siswa -->
    <div class="kartu">
        <div class="header">
            <img src="{{ public_path('assets/img/logo_smantig.png') }}" class="logo" alt="Logo Sekolah">
            <div class="header-text">
                <h4>DINAS PENDIDIKAN</h4>
                <h4>SMA NEGERI 3 BANDA ACEH</h4>
            </div>
        </div>

        <div class="content">
            <table class="content-table">
                <tr>
                    <td class="label">No. Ujian</td>
                    <td class="value">: {{ $data->nomor_ujian ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Peserta</td>
                    <td class="value">: {{ $data->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td class="label">NISN</td>
                    <td class="value">: {{ $data->nisn }}</td>
                </tr>
                <tr>
                    <td class="label">TTL</td>
                    <td class="value">: {{ $data->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Jenis Kelamin</td>
                    <td class="value">: {{ $data->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td class="label">Asal Sekolah</td>
                    <td class="value">: {{ $data->asal_sekolah }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <div class="photo">
                <img src="{{ storage_path('app/public/' . $data->foto) }}" class="student-photo" alt="Foto Siswa">
            </div>
            <div class="signature">
                <p>Ketua Panitia,</p>
                <strong>KAMARUDDIN, S.Pd.I</strong><br>
                <small>NIP: 197902202000031002</small>
            </div>
        </div>
    </div>

    <!-- Divider dengan dua label -->
    <div class="divider">
        <span class="divider-text top">Bagian Siswa</span>
        <span class="divider-text bottom">Bagian Panitia</span>
    </div>


    <!-- Kartu Ujian Panitia -->
    <div class="kartu">
        <div class="header">
            <img src="{{ public_path('assets/img/logo_smantig.png') }}" class="logo" alt="Logo Sekolah">
            <div class="header-text">
                <h4>DINAS PENDIDIKAN</h4>
                <h4>SMA NEGERI 3 BANDA ACEH</h4>
            </div>
        </div>

        <div class="content">
            <table class="content-table">
                <tr>
                    <td class="label">No. Ujian</td>
                    <td class="value">: {{ $data->nomor_ujian ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Peserta</td>
                    <td class="value">: {{ $data->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td class="label">NISN</td>
                    <td class="value">: {{ $data->nisn }}</td>
                </tr>
                <tr>
                    <td class="label">TTL</td>
                    <td class="value">: {{ $data->tempat_lahir }},
                        {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Jenis Kelamin</td>
                    <td class="value">: {{ $data->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td class="label">Asal Sekolah</td>
                    <td class="value">: {{ $data->asal_sekolah }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <div class="photo">
                <img src="{{ storage_path('app/public/' . $data->foto) }}" class="student-photo" alt="Foto Siswa">
            </div>
            <div class="signature">
                <p>Ketua Panitia,</p>
                <strong>KAMARUDDIN, S.Pd.I</strong><br>
                <small>NIP: 197902202000031002</small>
            </div>
        </div>
    </div>
</body>

</html>
