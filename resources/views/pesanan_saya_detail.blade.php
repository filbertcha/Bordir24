<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/bordir24.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pesanan Saya</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/riwayat_detail.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand fixed-top" id="nav">
        <a href="{{ route('/') }}"><img class="imgNav" src="{{ asset('img/bordir24_navnew.png') }}"
                alt=""></a>
        <div class="ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('img/profile-user.png') }}" class="user rounded-circle" alt="">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item disabled" href="#">Welcome : {{ Auth::user()->name }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Akun Saya</a></li>
                        <li><a class="dropdown-item" href="{{ route('pesanansaya') }}">Pesanan Saya</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('actionlogout') }}">Log out<i
                                    class="bi bi-box-arrow-right float-end"></i></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    @foreach ($det_pesanan as $item)
        <div class="container isi">
            <a class="btn btn-primary" style="margin-top: 10px; width:120px;" href="{{ route('pesanansaya') }}">Kembali</a>
            <div class="row m-0">
                <div class="col-lg-7 pb-5 pe-lg-5">
                    <div class="row">
                        <div class="col-12 p-5" style="display:flex; justify-content: center;">
                            <div class="img-frame">
                                <img src="{{ asset('storage/' . $item->nama_gambar) }}"
                                alt="">
                            </div>
                        </div>
                        <div class="row m-0 bg-light">
                            <div class="col-md-4 col-6 ps-30 pe-0 my-4">
                                <p class="text-muted">No Pesanan</p>
                                <p class="h5" id="no_pesanan">{{ $item->id }}</p>
                            </div>
                            <div class="col-md-4 col-6  ps-30 my-4">
                                <p class="text-muted">Waktu Pesan</p>
                                <p class="h5 m-0">{{ $item->created_at }}</p>
                            </div>
                            <div class="col-md-4 col-6 ps-30 my-4">
                                <p class="text-muted">Pengiriman</p>
                                @if ($item->servis == null)
                                    <p class="h5 m-0">Ambil Sendiri</p>
                                @else
                                    <p class="h5 m-0">{{ $item->servis }}</p>
                                @endif
                            </div>
                            <div class="col-md-4 col-6 ps-30 my-4">
                                <p class="h5 m-0">Deskripsi</p>
                                <p class="text-muted">{{ $item->deskripsi_tambahan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 p-0 ps-lg-4">
                    <div class="row m-0">
                        <div class="col-12 px-4">
                            <div class="d-flex align-items-end mt-4 mb-2">
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <p class="textmuted">Ukuran (cm<sup>2</sup>)</p>
                                @php
                                    $ukuranArray = explode(',', $item->ukuran);
                                    $ukuranPertama = trim($ukuranArray[0]);
                                    $ukuranKedua = trim($ukuranArray[1]);
                                    $ukuranKetiga = trim($ukuranArray[2]);
                                @endphp
                                <p class="fs-14 fw-bold">{{ $ukuranPertama }}</p>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <p class="textmuted">Jumlah Pesanan</p>
                                <p class="fs-14 fw-bold">{{ $item->jumlah_pesanan }}</p>
                            </div>
                            <div class="d-flex justify-content-between mb-2" style="border-top: 1px solid black;">
                                <p class="fs-14 fw-bold">Harga</p>
                                <?php $formatted_price = number_format($item->hrg_brg, 0, ',', '.'); ?>
                                <p class="fs-14 fw-bold">{{ $formatted_price }}</p>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <p class="textmuted">Ongkir</p>
                                <?php $formatted_price = number_format($item->hrg_ongkir, 0, ',', '.'); ?>
                                <p class="fs-14 fw-bold">{{ $formatted_price }}</p>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <p class="textmuted fw-bold">Total</p>
                                <div class="d-flex align-text-top ">
                                    <?php $formatted_price = number_format($item->total, 0, ',', '.'); ?>
                                    <span class="h4">{{ $formatted_price }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="row bg-light m-0">
                                <div class="col-12 px-4 my-4">
                                    <div class="d-flex  mb-4">
                                        <span class="">
                                            <p class="text-muted">Resi</p>
                                            @if ($item->resi == null)
                                                <input class="form-control" type="text" value="-">
                                            @else
                                                <input class="form-control" type="text" value="{{ $item->resi }}">
                                            @endif
                                        </span>
                                    </div>
                                    <div class="d-flex mb-5">
                                        <span class="me-5">
                                            <p class="text-muted">Tanggal Pembayaran</p>
                                            @if ($item->tanggal_bayar == null)
                                                <input class="form-control" type="text" value="-">
                                            @else
                                                <input class="form-control" type="text" value="{{ $item->tanggal_bayar }}">
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <div class="col-12  mb-4 p-0">
                                    @if ($item->id_status == 5)
                                    <div class="btn btn-primary bayar" type="button">Bayar</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".bayar").click(function(event) {
                event.preventDefault();
                var orderId = $('#no_pesanan').text();
                console.log(orderId);
                // Mendapatkan CSRF token dari meta tag
                var token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '{{ route('pay') }}',
                    type: 'post',
                    data: {
                        _token: token,
                        order_id: orderId
                    },
                    dataType: 'json',
                    success: function(response) {
                        var snapToken = response.snapToken;
                        if (snapToken) {
                            window.snap.pay(snapToken, {
                                onSuccess: function(result) {
                                    alert("payment success!");
                                    // Mengirim permintaan untuk memperbarui status pembayaran
                                    $.ajax({
                                        url: '{{ route('updatePaymentStatus') }}',
                                        type: 'post',
                                        data: {
                                            _token: token,
                                            order_id: orderId // Menggunakan ID pesanan yang sesuai
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            // Handle response jika diperlukan
                                        },
                                        error: function(xhr, status,
                                        error) {
                                            console.error(xhr
                                                .responseText);
                                            alert(
                                                "An error occurred while updating payment status.");
                                        }
                                    });
                                    window.location.href =
                                    '{{ route('pesanansaya') }}';
                                },
                                onPending: function(result) {
                                    alert("waiting your payment!");
                                    window.location.href =
                                    '{{ route('pesanansaya') }}';
                                },
                                onError: function(result) {
                                    alert("payment failed!");
                                    console.log(result);
                                },
                                onClose: function() {
                                    alert(
                                        'you closed the popup without finishing the payment');
                                    window.location.href =
                                    '{{ route('pesanansaya') }}';
                                }
                            });
                        } else {
                            alert("Snap token not found!");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert(
                            "An error occurred while processing your request. Please try again later.");
                    }
                });
            });
        });
    </script>
</body>

</html>
