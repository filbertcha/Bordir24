<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/bordir24.png') }}">
    <title>admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin_new.css') }}">
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
                            <a class="nav-link active" style="font-size: 25px" href="{{ route('admin') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="font-size: 25px" href="{{ route('pesanan') }}">Pesanan</a>
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
                                    <h5 class="text-muted">Total</h5>
                                    <h2 class="mb-0"> {{ $users->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Jumlah Admin</h5>
                                    <h2 class="mb-0"> {{ $users->where('role', 'admin')->count() }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-inline-block">
                                    <h5 class="text-muted">Jumlah User</h5>
                                    <h2 class="mb-0"> {{ $users->where('role', 'user')->count() }}</h2>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Akun</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->tipe }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td><a class="btn btn bg-primary edit-btn" type="button"
                                                        data-bs-toggle="modal" data-bs-target="#roleModal"
                                                        data-user-id="{{ $user->id }}"><i style="color: white"
                                                            class="bi bi-pencil-square"></i></a></td>
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
        <div class="modal fade" id="roleModal" tabindex="" aria-labelledby="roleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="alamatModalLabel">Ubah Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ Auth::check() ? route('pushrole') : route('home') }}" method="post"
                            enctype="multipart/form-data">
                            <input type="hidden" name="user_id" id="modal-user-id" value="">
                            @csrf
                            <select class="form-control" name="role" id="role">
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                            </select>
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
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
