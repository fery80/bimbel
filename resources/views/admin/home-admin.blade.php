
@extends('layoutadmin')

@section('konten')
<style>
        body {
            background-image: url("{{asset('image/bg.admin.png')}}");
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
        }
        .custom-header {
            background-color: #ADD8E6; /* Light blue background */
            text-align: center;
        }
        .mt {
            margin-top: 15%;
        }
        .mt1 {
            margin-top: 5%;
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
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class=" col-md-6 mb-4">
            <img src="{{asset('image/admin.png')}}" alt="Gambar Murid" class="mt login-foto">  
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div class="mt1 w-100">

                
                <table class="table">
                    <thead class="custom-header">
                        <tr><th colspan="4">Daftar Komplain</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td  class="text-center align-middle">masih belum ada komplain</td>                           
                        </tr>
                    </tbody>
                </table>
                
                <!-- Absen Table -->


            </div>
        </div>
    </div>
</div>

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
@endsection
