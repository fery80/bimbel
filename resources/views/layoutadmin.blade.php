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



    <style>
        body {
            background-color: #e9f1f6 ; /* Ganti dengan warna yang Anda inginkan */
        }
        #searchResults {
    border: 1px solid #ccc;
    max-height: 200px;
    overflow-y: auto;
    position: absolute;
    width: 100%;
    background-color: white;
    z-index: 1000;
}

.search-item {
    padding: 8px;
    cursor: pointer;
}

.search-item:hover {
    background-color: #f1f1f1;
}


    </style>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="homeadmin">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="registrasiadmin">Registrasi Akun</a></li>
 
                <li class="nav-item"><a class="nav-link" href="daftarakun">Daftar akun</a></li>
                <li class="nav-item"><a class="nav-link" href="jadwal">Jadwal</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Komplain</a></li>
                
                <li class="nav-item"><a class="nav-link" href="akun">Akun</a></li>
            </ul>
        </div>
    </div>
</nav>

@yield('konten')
 

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

<script>
$(document).ready(function() {
    var table = $('#akun').DataTable({
        // Set default pagination, search, dan sorting

    });

});


</script>

</html>
