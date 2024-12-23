<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS -->
    <!-- Muat Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Muat DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css">

    <!-- Muat jQuery terlebih dahulu -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Muat Bootstrap Bundle JS (termasuk Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Muat DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<style>
        body {
            background-image: url("{{ asset('image/bg.pengajar.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
        .login-foto {
            width: 100%; /* Membuat gambar responsif */
            max-width: 400px; /* Maksimal lebar gambar */
            margin: auto; /* Mengatur margin otomatis untuk sentralisasi */
            margin-left: 60px;
        }
        .custom-header {
            background-color: #ADD8E6; /* Light blue background */
            text-align: center;
        }
        .mt {
            margin-top: 8%;
        }
        .table {
            border-radius: 10px; 
            overflow: hidden; 
            background-color: rgba(255, 255, 255, 0.8); 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); 
        }
        .table th, .table td {
            padding: 15px; 
            border: 1px solid #ccc; 
        }
        .table thead {
            background-color: #ADD8E6; 
        }
        .modal-title {
    color: black !important; /* Pastikan teks terlihat */
}

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">JadwalApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="/pengajar">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/pengajar/jadwal">Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Materi</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kuis</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Absen</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Pengajuan Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Akun</a></li>
            </ul>
        </div>
    </div>
</nav>
@yield('konten')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-L5k7sULPzA8f6TeWj9n5EDOpH+F06/7U6dM9bFSSS7e4MyfZBY6+YB+Blr7DFlvY" crossorigin="anonymous"></script>
<script>
    function togglePassword() {
        var passwordInput = document.getElementById("exampleInputPassword1");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>

</body>
</html>
