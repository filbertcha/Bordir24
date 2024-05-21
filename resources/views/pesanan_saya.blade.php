<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/bordir24.png') }}">
    <title>Pesanan Saya</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/riwayat.css') }}">
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
    <div class="container center-table" style="margin-top: 140px">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Pesanan</th>
                                <th>Tanggal</th>
                                <th>Total Pembayaran</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item as $pesanans)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pesanans->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pesanans->created_at)->format('Y-m-d') }}</td>
                                    <td>{{ $pesanans->total }}</td>
                                    <td>
                                        @if ($pesanans->id_status == 0)
                                            Menunggu Konfirmasi
                                        @elseif ($pesanans->id_status == 1)
                                            Sedang Diproses
                                        @elseif ($pesanans->id_status == 2)
                                            Sedang Dikirim
                                        @elseif ($pesanans->id_status == 3)
                                            Selesai
                                        @elseif ($pesanans->id_status == 5)
                                            Belum Dibayar
                                        @else
                                            Dibatalkan
                                        @endif
                                    </td>
                                    <td><a class="btn btn bg-primary edit-btn" type="button"
                                            href="{{ url('/riwayat_detail/' . $pesanans->id) }}"><i style="color : #ffffff"
                                                class="bi bi-folder2-open"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
</body>

</html>
