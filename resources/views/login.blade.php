<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/bordir24.png') }}">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <img class="logo" src="{{ asset('img/bordir24.png') }}" alt="">
    <div class="container">
        <h2 class="title">Masuk</h2>
        <a href="{{ route('googlelogin') }}"><button class="googlebtn"><img class="gimg" src="{{ asset('img/google.png') }}" alt=""> Lanjut dengan google</button></a>
        <p>atau</p>
        <form action="{{ route('actionlogin') }}" method="post">
            @csrf
            <input type="text" placeholder="Email" name="email" required><br>
            <input type="password" placeholder="Password" name="password" required><br>
            <button class="loginbtn">Masuk</button><br>
            <div class="link">
                <a href="reset">Reset password</a>
            </div>
            <p class="link1">Tidak ada akun? <a href="create">Buat sekarang</a></p>
        </form>
    </div>

    <div class="container-register">
        <h2 class="title">Daftar</h2>
        <a href="{{ route('googlelogin') }}"><button class="googlebtn"><img class="gimg" src="{{ asset('img/google.png') }}" alt=""> Lanjut dengan google</button></a>
        <p>atau</p>
        <form action="{{ route('actionregister') }}" method="post">
            @csrf
            <input type="text" placeholder="Email" name="email" required><br>
            <input type="password" placeholder="Password" name="password" required><br>
            <button class="loginbtn">Buat akun</button><br>
            <p class="policy">Dengan klik "Buat akun" atau "Lanjutkan dengan Google",<br> Anda menyetujui Kebijakan Privasi.</p>
            <p class="link1">Sudah punya akun? <a href="login">Masuk</a></p>
        </form>
    </div>
    
    <div class="container-reset">
        <h2 class="title">Kirim Email Reset password</h2>
        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <input type="text" placeholder="Email" name="email"><br>
            <button class="resetbtn" type="submit">Kirim</button><br>
        </form>
        <div class="link">
            <a href="cancel">Cancel</a>
        </div>
    </div>

    @if(session('modal_message'))
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('modal_message') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</body>
<script>
    $(document).ready(function() {
        $('.container-reset').hide();
        $('.container-register').hide();

        $('a[href="reset"]').click(function(e) {
        e.preventDefault();
        $('.container').hide();
        $('.container-reset').show();
    });

        $('a[href="cancel"]').click(function(e) {
        e.preventDefault();
        $('.container-reset').hide();
        $('.container').show();
    });

        $('a[href="create"]').click(function(e) {
        e.preventDefault();
        $('.container').hide();
        $('.container-register').show();


    });

        $('a[href="login"]').click(function(e) {
        e.preventDefault();
        $('.container-register').hide();
        $('.container').show();
    });
});

    $(document).ready(function() {
        $('#myModal').modal('show');
    });

</script>
</html>