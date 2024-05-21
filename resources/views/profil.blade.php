<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('img/bordir24.png') }}">
        <title>Profile</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    </head>
    <body>
        <nav class="navbar navbar-expand fixed-top" id="nav">
            <a href="{{ route('/') }}"><img class="imgNav" src="{{ asset('img/bordir24_navnew.png') }}" alt=""></a>
            <div class="ms-auto">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('img/profile-user.png')}}" class="user rounded-circle" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(Auth::user()->role == 'admin')
                                <li><a class="dropdown-item disabled" href="#">Welcome : {{ Auth::user()->name }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin') }}">Admin</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Akun Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('actionlogout') }}">Log out<i class="bi bi-box-arrow-right float-end"></i></a></li>
                            @else
                                <li><a class="dropdown-item disabled" href="#">Welcome : {{ Auth::user()->name }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Akun Saya</a></li>
                                <li><a class="dropdown-item" href="{{ route('pesanansaya') }}">Pesanan Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('actionlogout') }}">Log out<i class="bi bi-box-arrow-right float-end"></i></a></li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row isi">
                <div class="col-md-3 mb-4">
                    <div class="list-group">
                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action active">Profil Saya</a>
                        <a href="{{ route('alamat') }}" class="list-group-item list-group-item-action">Alamat</a>
                        <a href="{{ route('reset_email') }}" class="list-group-item list-group-item-action">Reset Password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="{{ Auth::check()? route('username') : route('home') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h3>Profil Saya</h3>
                        <br>
                        <div class="mb-3 row">
                            <label for="lastName" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control profile" id="lastName" placeholder="{{ Auth::user()->email }}" disabled>
                            </div>
                        </div>
                        @if (Auth::user()->username_change == '0')
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control profile" id="name" name="name" value="{{ Auth::user()->name }}" aria-describedby="name" required>
                            </div>
                        </div>
                        <br>
                        <p class="mt-3">Username hanya dapat diubah 1 kali</p>
                        <br>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        @else
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control profile" placeholder="{{ Auth::user()->name }}" aria-describedby="name" disabled>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </body> 
</html>
