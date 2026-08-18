<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Akses Ditolak</title>
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <style>
        body { display:flex; align-items:center; justify-content:center; height:100vh; font-family:sans-serif; background:#f4f6f9; }
        .box { text-align:center; }
        .box i { font-size:80px; color:#d81d2a; }
    </style>
</head>
<body>
    <div class="box">
        <i class="fas fa-lock"></i>
        <h2>Akses Tidak Diizinkan</h2>
        <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}</p>
        <a href="{{ url()->previous() }}">Kembali</a>
    </div>
</body>
</html>