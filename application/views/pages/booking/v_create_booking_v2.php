<link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/select2/css/select2.min.css">

<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    <?= $title ?>s
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="<?= base_url('booking') ?>" class="btn btn-warning d-none d-sm-inline-block" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Back</a>
                    <a href="<?= base_url('booking') ?>" class="btn btn-warning d-sm-none btn-icon" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <form action="<?= base_url('booking/store_booking') ?>" method="post" class="card" id="formBooking">
                    <div class="card-body">
                        <h5></h5>
                        <?php
                        $role_id = $this->session->userdata('role_id');


                        if ($role_id == '3') {
                            $user_id = $this->session->userdata('user_id');
                            $id_customer = $this->session->userdata('customer_id');
                            // $id_customer = $this->M_Auth->getUserById($user_id)['customer_id']; 
                        ?>

                            <div class="row">
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nama pengirim</label>
                                        <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" placeholder="Masukkan nama pengirim" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">No Whatsapp pengirim</label>
                                        <input type="text" name="telepon_pengirim" id="telepon_pengirim" class="form-control" placeholder="Masukkan no whatsapp pengirim">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat pengirim</label>
                                        <textarea type="text" name="alamat_pengirim" id="alamat_pengirim" class="form-control" placeholder="Masukkan alamat pengirim" oninput="this.value = this.value.toUpperCase()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nama penerima</label>
                                        <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" placeholder="Masukkan nama penerima" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">No Whatsapp penerima</label>
                                        <input type="text" name="telepon_penerima" id="telepon_penerima" class="form-control" placeholder="Masukkan no whatsapp penerima">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Alamat penerima</label>
                                        <textarea type="text" name="alamat_penerima" id="alamat_penerima" class="form-control" placeholder="Masukkan alamat penerima" oninput="this.value = this.value.toUpperCase()"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis barang</label>
                                        <input type="text" name="jenis_barang" id="jenis_barang" class="form-control" placeholder="Masukkan jenis barang" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Koli</label>
                                        <input type="text" name="qty" id="qty" class="form-control angka" placeholder="Masukkan jumlah barang">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Berat timbang</label>
                                        <input type="text" name="berat_timbang" id="berat_timbang" class="form-control angka" placeholder="Masukkan berat timbang">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Chargeable</label>
                                        <input type="text" name="chargeable" id="chargeable" class="form-control angka" value="0" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Panjang</label>
                                        <input type="text" name="panjang" id="panjang" class="form-control angka" placeholder="Masukkan panjang">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Lebar</label>
                                        <input type="text" name="lebar" id="lebar" class="form-control angka" placeholder="Masukkan lebar">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Tinggi</label>
                                        <input type="text" name="tinggi" id="tinggi" class="form-control angka" placeholder="Masukkan tinggi">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Volume</label>
                                        <input type="text" name="volume" id="volume" class="form-control angka" value="0" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label for="origin" class="form-label">Origin</label>
                                        <input type="text" name="origin" id="origin" class="form-control" placeholder="Masukkan origin" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label for="destination" class="form-label">Destination</label>
                                        <input type="text" name="destination" id="destination" class="form-control" placeholder="Masukkan destination" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Per Kg</label>
                                        <input type="text" name="harga" id="harga" class="form-control" value="0" readonly>
                                        <div class="invalid-feedback">Harga tidak tersedia</div>
                                        <div class="valid-feedback">Harga tersedia</div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nominal</label>
                                        <input type="text" name="nominal" id="nominal" class="form-control angka" value="0" readonly>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } ?>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary ms-auto btn-submit">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets/dashboard/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>assets/vendor/select2/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        $('.select2').select2();

        // Menggunakan mask untuk input uang
        $('.angka').mask('000.000.000.000.000', {
            reverse: true
        });

        $('#berat_timbang').on('input', function() {
            tentukanChargeable();
            hitungNominal();
        });

        $('#panjang').on('input', function() {
            hitungDimensi();
            tentukanChargeable();
        });

        $('#lebar').on('input', function() {
            hitungDimensi();
            tentukanChargeable();
        });

        $('#tinggi').on('input', function() {
            hitungDimensi();
            tentukanChargeable();
        });

        function hitungDimensi() {
            var panjang = $('#panjang').val();
            panjang = panjang ? panjang.replace(/\./g, '') : '0';

            var lebar = $('#lebar').val();
            lebar = lebar ? lebar.replace(/\./g, '') : '0';

            var tinggi = $('#tinggi').val();
            tinggi = tinggi ? tinggi.replace(/\./g, '') : '0';


            var volume = (panjang * lebar * tinggi) / 5000;

            $('#volume').val(formatNumber(volume));

            tentukanChargeable();
        }

        function tentukanChargeable() {
            var chargeable;

            var berat_timbang = parseFloat($('#berat_timbang').val().replace(/\./g, '')) || 0;

            var volume = parseFloat($('#volume').val().replace(/\./g, '')) || 0;

            if (berat_timbang >= volume) {
                chargeable = berat_timbang;
            } else {
                chargeable = volume;
            }

            $('#chargeable').val(formatNumber(chargeable));

            hitungNominal();
        }

        function formatNumber(number) {
            // Pisahkan bagian integer dan desimal
            let parts = number.toString().split(".");

            // Format bagian integer dengan pemisah ribuan
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // Gabungkan bagian integer dan desimal dengan koma sebagai pemisah desimal
            return parts.join(",");
        }

        $('#origin, #destination').on('input', function() {
            var origin = $('#origin').val();
            var destination = $('#destination').val();
            if (origin && destination) {
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url('booking/getPrice'); ?>',
                    data: {
                        origin: origin,
                        destination: destination,
                    },
                    cache: false,
                    success: function(response) {
                        var harga = parseFloat(response);
                        console.log(harga)

                        if (!isNaN(harga) && harga > 0) {
                            $('#harga').removeClass('is-invalid').addClass('is-valid');
                        } else {
                            $('#harga').removeClass('is-valid').addClass('is-invalid');
                        }

                        $('#harga').val((harga));
                        hitungNominal();
                    },
                    error: function() {
                        console.log('Price not found');
                        $('#harga').removeClass('is-valid').addClass('is-invalid');
                    }
                })
            }
        });

        function hitungNominal() {
            var chargeable = parseFloat($('#chargeable').val().replace(/\./g, '')) || 0;
            // var harga = parseFloat($('#harga').val().replace(/\./g, '')) || 0;
            var harga = parseFloat($('#harga').val()) || 0;

            var nominal;

            nominal = Math.round(chargeable * harga);
            $('#nominal').val(formatNumber(nominal));
        }

        $(document).on("click", ".btn-submit", function(e) {
            e.preventDefault();
            const form = $(this).parents("form");


            // Validasi semua input form
            let inputs = form.find('input, select, textarea');
            let valid = true;

            inputs.each(function() {
                if (!$(this).val()) {
                    $(this).addClass('is-invalid');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });

            // Jika ada input yang tidak valid, cegah submit dan tampilkan peringatan
            if (!valid) {
                Swal.fire({
                    icon: 'error',
                    text: 'Please fill out all required fields!'
                });
                return;
            }

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, confirm!",
            }).then((result) => {
                if (result.isConfirmed) {

                    form.on("submit", function() {
                        $(".btn-submit").prop('disabled', true);
                        Swal.fire({
                            title: "Loading...",
                            timerProgressBar: true,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    });

                    form.submit();
                }
            });
        });
    });
</script>