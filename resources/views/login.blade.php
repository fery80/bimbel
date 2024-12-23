<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url("{{ asset('image/bg.login.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
        .login-foto{
            margin-top: 15%;
            max-width: 100%;
            width: 500px;
            display: block;
            margin-left: auto;
            margin-right: 200px;
        }
        .form-login{
            margin-top: 10%;
            background-color: #fff;
            max-width: 100%;
            width: 100%;
            padding: 20px;
            border-radius: 5%;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('image/login.murid.png') }}" alt="Gambar Murid" class="login-foto">
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <form class="form-login" action="{{ route('login.submit') }}" method="POST">
                    @csrf
                    <h1 class="text-center">Login</h1>
                    
                    <!-- NIS Field -->
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" name="nomor_induk" class="form-control" id="nis" required>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="showPassword" onclick="togglePassword()">
                            <label class="form-check-label" for="showPassword">Show Password</label>
                        </div>
                    </div>

                    <!-- Jika ada error, tampilkan pesan -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <b>bjir eror</b>
                            {{ $errors->first('error') }}
                        </div>
                    @endif

                    <p>Jika Anda Lupa Password Silakan <a href="https://example.com/hubungi-admin" target="#">Hubungi Admin</a></p>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" style="width: 800px;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>
