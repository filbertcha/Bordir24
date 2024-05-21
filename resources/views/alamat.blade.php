<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('img/bordir24.png') }}">
        <title>Alamat</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                            <li><a class="dropdown-item disabled" href="#">Welcome : {{ Auth::user()->name }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Akun Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('pesanansaya') }}">Pesanan Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('actionlogout') }}">Log out<i class="bi bi-box-arrow-right float-end"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row isi">
                <div class="col-md-3 mb-4">
                    <div class="list-group">
                        <a href="{{ route('profile') }}" class="list-group-item list-group-item-action">Profil Saya</a>
                        <a href="{{ route('alamat') }}" class="list-group-item list-group-item-action active">Alamat</a>
                        <a href="{{ route('reset_email') }}" class="list-group-item list-group-item-action">Reset Password</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="{{ Auth::check()? route('storealamat') : route('home') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h3>Alamat Saya</h3>
                        <br>
                        <div class="mb-3 row">
                            <label for="lastName" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                @if (Auth::user()->username == null)
                                    <input type="text" class="form-control profile" id="username" name="username" disabled>
                                @else
                                    <input type="text" class="form-control profile" id="username" name="username" placeholder="{{ Auth::user()->username }}" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-3 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-9">
                                @if (Auth::user()->telp == null)
                                    <input type="number" class="form-control profile" id="tlp" name="tlp" disabled>
                                @else
                                    <input type="number" class="form-control profile" id="tlp" name="tlp" placeholder="{{ Auth::user()->telp }}" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                @if (Auth::user()->alamat == null)
                                    <input type="text" class="form-control profile" id="alamat" name="alamat" disabled>
                                @else
                                    <input type="text" class="form-control profile" id="alamat" name="alamat" placeholder="{{ Auth::user()->alamat }}" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-4">
                                @if (Auth::user()->provinsi == null)
                                    <input type="text" class="form-control profile" id="alamat" name="alamat" disabled>
                                @else
                                    <input type="text" class="form-control profile" id="alamat" name="alamat" placeholder="{{ Auth::user()->provinsi }}" disabled>
                                @endif                              
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Kota</label>
                            <div class="col-4">
                                @if (Auth::user()->kota == null)
                                    <input type="text" class="form-control profile" id="alamat" name="alamat" disabled>
                                @else
                                    <input type="text" class="form-control profile" id="alamat" name="alamat" placeholder="{{ Auth::user()->kota }}" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Kode Pos</label>
                            <div class="col-4">
                                @if (Auth::user()->kodepos == null)
                                    <input type="text" class="form-control profile" id="alamat" name="alamat" disabled>
                                @else
                                    <input type="text" class="form-control profile" id="alamat" name="alamat" placeholder="{{ Auth::user()->kodepos }}" disabled>
                                @endif
                            </div>
                        </div>
                        <br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#alamatModal">Edit Alamat</button>
                        <div class="modal fade" id="alamatModal" tabindex="" aria-labelledby="alamatModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="alamatModalLabel">Alamat Saya</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ Auth::check()? route('storealamat') : route('home') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <!-- Isi formulir alamat di sini -->
                                            <div class="mb-3 row">
                                                <label for="lastName" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                <div class="col-sm-9">
                                                    @if (Auth::user()->username == null)
                                                        <input type="text" class="form-control profile1" id="username" name="username" required>
                                                    @else
                                                        <input type="text" class="form-control profile1" id="username" name="username" value="{{ Auth::user()->username }}" required>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="address" class="col-sm-3 col-form-label">Nomor Telepon</label>
                                                <div class="col-sm-9">
                                                    @if (Auth::user()->telp == null)
                                                        <input type="number" class="form-control profile1" id="tlp" name="tlp" required>
                                                    @else
                                                        <input type="number" class="form-control profile1" id="tlp" name="tlp" value="{{ Auth::user()->telp }}" required>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                                                <div class="col-sm-9">
                                                    @if (Auth::user()->alamat == null)
                                                        <input type="text" class="form-control profile1" id="alamat" name="alamat" required>
                                                    @else
                                                        <input type="text" class="form-control profile1" id="alamat" name="alamat" value="{{ Auth::user()->alamat }}" required>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="email" class="col-sm-3 col-form-label">Provinsi</label>
                                                <div class="col-4">
                                                    <select class="form-control profile1" id="provinsi" name="provinsi">
                                                        <option>---</option>
                                                        @foreach ($provinsi as $item)
                                                            <option value="{{ $item->name }}" data-name="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>                                                                       
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="email" class="col-sm-3 col-form-label">Kota</label>
                                                <div class="col-4">
                                                    <select class="form-control profile1" id="kota" name="kota">
                                                    </select>
                                                    <input type="hidden" id="kotaIdInput" name="kota_id" value=""> 
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="email" class="col-sm-3 col-form-label">Kode Pos</label>
                                                <div class="col-4">
                                                    <select class="form-control profile1" id="kodepos" name="kodepos">
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
        <script>
            $('#kota').on('change', function() {
                var selectedOption = $(this).find(':selected');
                var kotaId = selectedOption.data('name');
                $('#kotaIdInput').val(kotaId);
            });

            $(document).ready(function(){
                $('#provinsi').on('change', function(){
                    var kode_provinsi = $(this).find(':selected').data('name');
                    console.log(kode_provinsi);
                    if (kode_provinsi) {
                        $.ajax({
                            url:'alamat/kota/' + kode_provinsi,
                            type: 'GET',
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(data_kota){
                                if (data_kota) {
                                    $('#kota').empty();
                                    $('#kota').append('<option value="">---</option>');
                                    $.each(data_kota, function(key, kota){
                                        $('#kota').append('<option value="' + kota.name + '" data-name="' + kota.id + '">' + kota.name + '</option>');
                                    });
                                }
                            }
                        });
                    }
                });

                $('#kota').on('change', function(){
                    var kode_kodepos = $(this).find(':selected').data('name');
                    console.log(kode_kodepos);
                    if (kode_kodepos) {
                        $.ajax({
                            url:'alamat/kodepos/' + kode_kodepos,
                            type: 'GET',
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(data_kodepos){
                                if (data_kodepos) {
                                    $('#kodepos').empty();
                                    $('#kodepos').append('<option value="">---</option>');
                                    $.each(data_kodepos, function(key, kodepos){
                                        $('#kodepos').append('<option value="' + kodepos.postal_code + '" data-name="' + kodepos.id + '">' + kodepos.postal_code + '</option>');
                                    });
                                }
                            }
                        })
                    }
                });

                $('#kecamatan').on('change', function(){
                    var kode_kecamatan = $(this).val();
                    console.log(kode_kecamatan);
                    if (kode_kecamatan) {
                        $.ajax({
                            url:'alamat/kodepos/' + kode_kecamatan,
                            type: 'GET',
                            data: {
                                '_token': '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(data_kodepos){
                                if (data_kodepos) {
                                    $('#kodepos').empty();
                                    $('#kodepos').append('<option value="">---</option>');
                                    $.each(data_kodepos, function(key, kodepos){
                                        $('#kodepos').append('<option value="' + kodepos.kodepos + '">' + kodepos.kodepos + '</option>');
                                    });
                                }
                            }
                        })
                    }
                });
            });
        </script>
    </body> 
</html>