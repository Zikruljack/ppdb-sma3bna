<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Seleksi PPDB</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.5;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .email-header {
            text-align: center;
            padding-bottom: 20px;
        }

        .email-footer {
            font-size: 14px;
            color: #777;
            text-align: center;
        }

        .email-footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h2>Informasi Hasil Seleksi PPDB</h2>
        </div>

        <p>Dear {{ ucfirst($user->name) }},</p>

        <p>Terima kasih telah mendaftar sebagai peserta SPMB. Berikut adalah informasi terkait dengan hasil seleksi
            Anda:</p>

        <ul>
            <li><strong>Nama Lengkap:</strong> {{ ucfirst($ppdbUser->nama_lengkap) }}</li>
            <li><strong>NISN:</strong> {{ $ppdbUser->nisn }}</li>
            <li><strong>Jalur Pendaftaran:</strong> {{ ucfirst($ppdbUser->jalur_pendaftaran) }}</li>
        </ul>

        <p>Status validasi Anda saat ini adalah: {{ $ppdbUser->status }}</p>

        @if ($ppdbUser->status == 'tidak_valid')
            <p>Mohon maaf, data Anda tidak lolos seleksi SPMB.</p>
        @elseif ($ppdbUser->status == 'perbaikan')
            <p>Anda perlu memperbaiki data Anda dan mengupload ulang dokumen yang diperlukan.</p>
        @elseif($ppdbUser->status == 'valid')
            <p>Selamat! Anda telah lolos seleksi SPMB. Silahkan datang ke sekolah untuk melanjutkan proses pendaftaran.
            </p>
        @endif

        <p>Terima kasih atas perhatian Anda.</p>

        <div class="email-footer">
            <p>Salam Panitia,</p>
            <p><strong>Panitia SPMB SMA Negeri 3 Banda Aceh</strong></p>
        </div>
    </div>
</body>

</html>
