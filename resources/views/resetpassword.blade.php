<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <img class="logo" src="{{ asset('img/logo.png') }}" alt="">
    <div class="container">
        <h2 class="title">Reset Password</h2>
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ request()->token }}"><br>
            <input type="email" name="email" placeholder="Masukkan Email"><br>
            <input type="password" placeholder="Password" name="password" required><br>
            <input type="password" placeholder="Konfirmasi Password" name="password_confirmation" required><br>
            <button class="loginbtn">Reset</button><br>
        </form>
    </div>
</body>
</html>