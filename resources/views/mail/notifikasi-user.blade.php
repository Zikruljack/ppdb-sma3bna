<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Notifikasi</title>
</head>

<body>
    <h2>Notifikasi</h2>
    <p>Anda memiliki notifikasi baru:</p>
    <ul>
        @foreach ($notifications as $notification)
            <li>{{ $notification->data['message'] }}</li>
        @endforeach
    </ul>
    <p>Terima kasih telah menggunakan layanan kami.</p>
</body>

</html>
