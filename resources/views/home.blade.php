<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/bordir24.png') }}">
    <title>Bordir24</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand fixed-top" id="nav">
        <a href="{{ route('/') }}"><img class="imgNav" src="{{ asset('img/bordir24_navnew.png') }}"
                alt=""></a>
        <div class="ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    @if (Auth::check())
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('img/profile-user.png') }}" class="user rounded-circle" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if (Auth::user()->role == 'admin')
                                <li><a class="dropdown-item disabled" href="#">Welcome :
                                        {{ Auth::user()->name }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin') }}">Admin</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('actionlogout') }}">Log out<i
                                            class="bi bi-box-arrow-right float-end"></i></a></li>
                            @else
                                <li><a class="dropdown-item disabled" href="#">Welcome :
                                        {{ Auth::user()->name }}</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Akun Saya</a></li>
                                <li><a class="dropdown-item" href="{{ route('pesanansaya') }}">Pesanan Saya</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('actionlogout') }}">Log out<i
                                            class="bi bi-box-arrow-right float-end"></i></a></li>
                            @endif
                        </ul>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-warning btnlogin">Login</a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>
    <div class="bg-image" style="background-image: url('{{ asset('img/background.png') }}');">
        <div class="mask">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="desHome text-white text-center">
                            <h1 style="font-size: 40pt">Bordir 24</h1>
                            <h4 style="font-size: 25pt">Jasa Bordir Komputer Malang</h4>
                            <a href="{{ route('pesan') }}" class="btn btn-warning btn-lg">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="slide2">
        <div class="tag">
            <div class="tagCont">
                <div class="tagDesk">
                    <h4>Harga</h4>
                    <div class="rinciHarga">
                        <p>Rp. 100/cm</p>
                        <p class="hKecil">2 </p>
                    </div>
                </div>
                <img src="{{ asset('img/noun-price-1921686-white.png') }}" alt="">
            </div>
            <div class="tagCont">
                <div class="tagDesk">
                    <h4>Kualitas</h4>
                    <p>Menggunakan bahan dengan kualitas tinggi</p>
                </div>
                <img src="{{ asset('img/reliability.png') }}" alt="">
            </div>
            <div class="tagCont">
                <div class="tagDesk">
                    <h4>Desain</h4>
                    <p>Desain Custom dari anda</p>
                </div>
                <img src="{{ asset('img/customize.png') }}" alt="">
            </div>
            <div class="tagCont">
                <div class="tagDesk">
                    <h4>Pengerjaan</h4>
                    <p>Waktu pengerjaan yang cepat</p>
                </div>
                <img src="{{ asset('img/clock.png') }}" alt="">
            </div>
            <div class="tagCont">
                <div class="tagDesk">
                    <h4>Pengiriman</h4>
                    <p>Menggunkan pengiriman kurir</p>
                </div>
                <img src="{{ asset('img/delivery.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Akhir Deskripsi Produk -->

    <div class="container">
        <div class="galeriProduk">
            <h4>Galeri Produk</h4>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <img src="{{ asset('img/nama_dada.png') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5>Nama Dada</h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <img src="{{ asset('img/patch.png') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5>Patch Bordir</h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <img src="{{ asset('img/timbul.png') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5>Patch Bordir Timbul</h5>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <img src="{{ asset('img/bordir baju.png') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5>Bordir Baju</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kontak -->
    <div class="slide3">
        <div class="judul">
            <h2>Hubungi Kami</h2>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="heroKontak">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15803.478153650503!2d112.63178374612008!3d-8.01238749443965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd62798a3fce059%3A0xad82f7679bc7936d!2sJl%20kh%20malik%20dalam!5e0!3m2!1sid!2sid!4v1715735265981!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-6">
                    <div class="desKontak">
                        <a class="googlemaps btn" href="https://maps.app.goo.gl/MBQW1JmVYza5YQRp9">
                            <h4>Gunakan google maps</h4>
                            <img src="{{ asset('img/location-pin.png') }}" alt="">
                        </a>
                        <div class="rinciKontak">
                            <h4>Detail</h4>
                            <p>
                                Jl. KH. Malik Dalam Gg. 7 No.Dalam, Buring, Kec. Kedungkandang, Kota Malang, Jawa Timur
                                65136
                            </p>
                            <h4>Kontak</h4>
                            <p>
                                085101738987<br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Kontak -->


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 50) {
                $('nav').addClass('scrolled');
            } else {
                $('nav').removeClass('scrolled'); /* Hapus kelas 'scrolled' */
            }
        });
    });

    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    $(document).ready(function() {
        scrollToTop(); // Panggil fungsi scrollToTop
    });
</script>

</html>
