<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('img/bordir24.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin_new.css') }}">
    <title>Pesanan</title>
</head>

<body>
    <nav class="navbar navbar-expand fixed-top" id="nav">
        <a href="{{ route('admin') }}"><img class="imgNav" src="{{ asset('img/bordir24_navnew.png') }}"
                alt=""></a>
        <div class="ms-auto">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('img/profile-user.png') }}" class="user rounded-circle" alt="">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item disabled" href="#">Welcome : {{ Auth::user()->name }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('pesanan') }}">Pesanan</a></li>
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
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item" style="margin-top: 50px;">
                            <a class="nav-link" style="font-size: 25px" href="{{ route('admin') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="font-size: 25px"
                                href="{{ route('pesanan') }}">Pesanan</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="dashboard-wrapper">
        <div class="dashboard-influence">
            <div class="container-fluid dashboard-content">
                <div class="row card1">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Jumlah Pesanan</h5>
                                    <h2 class="mb-0"> {{ $pesanan->whereIn('id_status', [0, 1])->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Terkirim</h5>
                                    <h2 class="mb-0"> {{ $pesanan->where('id_status', 2)->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Selesai</h5>
                                    <h2 class="mb-0"> {{ $pesanan->where('id_status', 3)->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Dibatalkan</h5>
                                    <h2 class="mb-0"> {{ $pesanan->where('id_status', 4)->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Pendapatan</h5>
                                    <h2 class="mb-0"> Rp
                                        {{ number_format($pesanan->where('id_status', 3)->sum('hrg_brg'), 0, ',', '.') }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Total Pendapatan</h5>
                                    <h2 class="mb-0"> Rp
                                        {{ number_format($pesanan->where('id_status', 3)->sum('total'), 0, ',', '.') }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No. Pesanan</th>
                                            <th>Tanggal</th>
                                            <th>Name</th>
                                            <th>Total Pembayaran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesanan as $pesanans)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $pesanans->id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($pesanans->created_at)->format('Y-m-d') }}
                                                </td>
                                                <td>{{ $pesanans->nama_user }}</td>
                                                <td>{{ number_format($pesanans->total, 0, ',', '.') }}</td>
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
                                                        href="{{ url('/detail/' . $pesanans->id) }}"><i
                                                            style="color : #ffffff"
                                                            class="bi bi-folder2-open"></i></a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
        <script>
            new DataTable('#example');
            $(document).ready(function() {
                $('.edit-btn').click(function() {
                    var userId = $(this).data('user-id');
                    $('#modal-user-id').val(userId);
                });
            });
        </script>
        <script src="js/popper.js"></script>
        <script src="js/main.js"></script>
</body>

</html>
