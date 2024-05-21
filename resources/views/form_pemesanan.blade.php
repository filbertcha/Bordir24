<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/bordir24.png') }}">
    <title>form pemesanan</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/form_pemesanan.css') }}">
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
    
    <div class="page-wrapper p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h2 class="title">Form Pemesanan</h2>
                </div>
                <div class="card-body">
                    <form action="{{ Auth::check() ? route('pesansekarang') : route('home') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="name">Ukuran</div>
                            <div class="value">
                                <div class="row">
                                    <div class="col-2">
                                        <input class="input--style-6" type="number" id="panjang" name="panjang" required>
                                        <label class="label--desc">Panjang</label>
                                    </div>
                                    <div class="col-2">
                                        <input class="input--style-6" type="number" id="lebar" name="lebar" required>
                                        <label class="label--desc">Lebar</label>
                                    </div>
                                    <input class="form-control size1" type="number" id="jumlah" name="jumlah" hidden>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Jumlah Pesanan</div>
                            <div class="value">
                                <input class="input--style-6" type="number" id="jumlah_pesanan" name="jumlah_pesanan" min="12" required
                                    onchange="checkInput(this)">
                                <label class="label--desc min">Minimal Pembelian 12</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Unggah Gambar</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="input-file" type="file" name="file" id="file"
                                        accept=".jpg,.jpeg,.png" required>
                                    <label class="label--file" for="file">Pilih Gambar</label>
                                    <span class="input-file__info">Tidak ada gambar dipilih</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Deskripsi Tambahan</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="deskripsi_tambahan" id="deskripsi_tambahan" maxlength="255" required></textarea>
                                    <label class="label--desc min">Maksimal Panjang 255</label>
                                </div>
                            </div>
                        </div>

                        {{-- HIDDEN INPUT --}}
                        <input type="hidden" id="total_harga" name="total_harga" value="">
                        <input type="hidden" id="total_barang" name="total_barang" value="">
                        <input type="hidden" id="total_ongkir" name="total_ongkir" value="">
                        <input type="hidden" value="{{ Auth::user()->id_kota }}" id="id_kota">

                        <div class="form-row">
                            <div class="name">Alamat</div>
                            <div class="value">
                                <textarea class="textarea--style-6" readonly onclick="window.location.href = '{{ route('alamat') }}';"
                                    style="cursor: pointer; min-height: 100px;">
{{ Auth::user()->username }}, {{ Auth::user()->telp }}
{{ Auth::user()->alamat }}                                                      
{{ Auth::user()->provinsi }}, {{ Auth::user()->kota }}, {{ Auth::user()->kecamatan }}, {{ Auth::user()->kodepos }}
                                </textarea>
                                <label class="label--desc min">Ketuk untuk ubah</label>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Pilih Pengiriman</div>
                            <div class="value">
                                <div class="input-group">
                                    <select class="form-control kirim" id="pengiriman" name="pengiriman">
                                        <option value="0">Ambil Sendiri</option>
                                        <option value="1">Kurir</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="kurir_section" style="display: none;">
                            <div class="name">Pilih Kurir</div>
                            <div class="value">
                                <div class="input-group">
                                    <select class="form-control" id="pilih_kurir" name="pilih_kurir">
                                        <option value="None">---</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS</option>
                                        <option value="tiki">TIKI</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="service_select" style="display: none;">
                            <div class="name">Pilih Service</div>
                            <div class="value">
                                <div class="input-group">
                                    <select class="form-control kirim" id="service" name="service">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="body-wrap">
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td class="container" width="600">
                                        <div class="content">
                                            <table class="main" width="100%" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                    <tr>
                                                        <td class="content-wrap aligncenter">
                                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="content-block">
                                                                            <table class="invoice">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <table class="invoice-items"
                                                                                                cellpadding="0"
                                                                                                cellspacing="0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td>Ukuran (cm <sup>2</sup>) </td>
                                                                                                        <td></td>
                                                                                                        <td
                                                                                                            class="alignright" id="text_jumlah">
                                                                                                            0</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Jumlah Pesanan </td>
                                                                                                        <td></td>
                                                                                                        <td
                                                                                                            class="alignright" id="jum_pes">
                                                                                                            0</td>
                                                                                                    </tr>
                                                                                                    <tr class="total1">
                                                                                                        
                                                                                                        <td class="alignright"
                                                                                                            width="80%">
                                                                                                            Harga</td>
                                                                                                        <td></td>
                                                                                                        <td
                                                                                                            class="alignright" id="harga">
                                                                                                            0</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Ongkir</td>
                                                                                                        <td></td>
                                                                                                        <td
                                                                                                            class="alignright" id="ongkir">
                                                                                                            0</td>
                                                                                                    </tr>
                                                                                                    <tr class="total">
                                                                                                        <td class="alignright"
                                                                                                            width="80%">
                                                                                                            Total</td>
                                                                                                        <td></td>
                                                                                                        <td
                                                                                                            class="alignright" id="total" name="total">
                                                                                                            0</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-footer">
                            <button class="btn btn--radius-2 btn--blue-2" type="submit">Buat Pesanan</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            var val_jum_pes = 0;

            $('#panjang').on('change', function() {
                var val_panjang = $(this).val();
                calculateArea();
                calculatePrice();
            });

            $('#lebar').on('change', function() {
                var val_lebar = $(this).val();
                calculateArea();
                calculatePrice();
            });

            $('#jumlah_pesanan').on('change', function() {
                val_jum_pes = $(this).val();
                $('#jum_pes').text(val_jum_pes);
                calculateArea();
                calculatePrice();
            });
            
            function calculateArea() {
                var val_panjang = $('#panjang').val();
                var val_lebar = $('#lebar').val();
                var luas = val_panjang * val_lebar;
                $('#jumlah').val(luas);
                $('#text_jumlah').text(luas);
            }

            function calculatePrice() {
                var harga = $('#text_jumlah').text() * 100;
                var total_harga = val_jum_pes * harga;
                $('#harga').text(total_harga.toLocaleString('id-ID'));
                $('#total_barang').val(total_harga);
                calculateTotal();
            }

            function calculateTotal() {
                var total_harga = parseFloat($('#total_barang').val());
                var total_ongkir = parseFloat($('#total_ongkir').val());
                if (isNaN(total_harga)) {
                    total_harga = 0;
                }
                if (isNaN(total_ongkir)) {
                    total_ongkir = 0;
                }
                var total = total_harga + total_ongkir;
                $('#total').text(total.toLocaleString('id-ID'));
                $('#total_harga').val(total);    
            }

            $('#pengiriman').change(function() {
                if ($(this).val() == 0) {
                    $('#kurir_section').hide();
                    $('#service_select').hide();
                    $('#pilih_kurir').removeAttr('required');
                    $('#service').removeAttr('required');
                } else {
                    $('#kurir_section').show();
                    $('#service_select').show();
                    $('#pilih_kurir').prop('required', true);
                    $('#service').prop('required', true);
                }
            });

            $('#service').change(function() {
                var selectedService = $(this).val();
                var shippingCost = parseFloat($('#service option:selected').text().split('- ')[1]);
                $('#total_ongkir').val(shippingCost);
                $('#ongkir').text(shippingCost.toLocaleString('id-ID'));
                calculateTotal();
            });
        });

        $('#pilih_kurir').on('change', function(e) {
            e.preventDefault();
            let origin = 142;
            let destination = $('#id_kota').val();
            let courier = $('#pilih_kurir').val();
            let weight = 1;
            console.log(origin);
            console.log(destination);
            console.log(courier);
            console.log(weight);
            $.ajax({
                url: "{{ route('check-ongkir') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    origin: origin,
                    destination: destination,
                    courier: courier,
                    weight: weight

                },
                success: function(response) {
                    $('#service').empty();
                    $('#service').append('<option value="None">---</option>');
                    if (courier === 'pos') {
                        $.each(response, function(i, val) {
                            $('#service').append('<option value="' + val.service + '">' + val
                                .service + ', ' + val.cost[0].etd + ', - ' + val.cost[0]
                                .value + '</option>');
                        });
                    } else {
                        // Tampilkan opsi dengan val.description
                        $.each(response, function(i, val) {
                            $('#service').append('<option value="' + val.service + '">' + val
                                .service + ' (' + val.description + '), ' + val.cost[0]
                                .etd + ', - ' + val.cost[0].value + '</option>');
                        });
                    }
                }
            });
        });

        function checkInput(input) {
            var element = document.querySelector('.min');
            if (input.validity.rangeUnderflow) {
                element.style.color = 'red';
            } else {
                element.style.color = '';
            }
        }

        (function($) {
            'use strict';

            try {
                var file_input_container = $('.js-input-file');
                if (file_input_container[0]) {
                    file_input_container.each(function() {
                        var that = $(this);
                        var fileInput = that.find(".input-file");
                        var info = that.find(".input-file__info");
                        fileInput.on("change", function() {
                            var fileName;
                            fileName = $(this).val();
                            if (fileName.substring(3, 11) == 'fakepath') {
                                fileName = fileName.substring(12);
                            }
                            if (fileName == "") {
                                info.text("No file chosen");
                            } else {
                                info.text(fileName);
                            }
                        })
                    });
                }
            } catch (e) {
                console.log(e);
            }
        })(jQuery);
    </script>
</body>
</html>
