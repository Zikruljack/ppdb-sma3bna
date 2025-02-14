<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        .header {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .foto {
            text-align: center;
            margin-bottom: 10px;
        }

        .foto img {
            width: 100px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="header">FORMULIR PENDAFTARAN PPDB</div>
    <div class="foto">
        <img src="" alt="Foto">
    </div>
    <table>
        <tr>
            <td><strong>Nama</strong></td>
            <td>{{ $data->nama_lengkap }}</td>
        </tr>
        <tr>
            <td><strong>NIK</strong></td>
            <td>{{ $data->nik }}</td>
        </tr>
        <tr>
            <td><strong>Jenis Kelamin</strong></td>
            <td>{{ $data->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td><strong>Alamat</strong></td>
            <td>{{ $data->alamat }}</td>
        </tr>
    </table>
    <div class="header">Nilai Rapor</div>
    <table>
        <tr>
            <th>Semester</th>
            <th>Agama</th>
            <th>B. Indo</th>
            <th>B. Inggris</th>
            <th>Matematika</th>
            <th>IPA</th>
            <th>IPS</th>
        </tr>
        @foreach ($nilaiRapor as $nilai)
            <tr>
                <td>{{ $nilai->semester }}</td>
                <td>{{ $nilai->agama }}</td>
                <td>{{ $nilai->b_indonesia }}</td>
                <td>{{ $nilai->b_inggris }}</td>
                <td>{{ $nilai->matematika }}</td>
                <td>{{ $nilai->ipa }}</td>
                <td>{{ $nilai->ips }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
