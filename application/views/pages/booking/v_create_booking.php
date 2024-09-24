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
                <form action="<?= base_url('booking/store_booking') ?>" method="post" class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Customer</label>
                                    <select class="select2 form-select" name="customer_id" id="customer_id" style="width: 100%" required>
                                        <option value="">:: Pilih customer</option>
                                        <?php
                                        foreach ($customers as $c) :
                                        ?>
                                            <option value="<?= $c->id ?>"><?= $c->nama_customer ?></option>
                                        <?php
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Titik jemput</label>
                                    <input name="alamat_pickup" id="alamat_pickup" class="form-control" placeholder="Masukkan titik penjemputan..." oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Lokasi gudang</label>
                                    <input name="lokasi_gudang" id="lokasi_gudang" class="form-control" placeholder="Masukkan lokasi gudang pengantaran..." oninput="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>AWB</th>
                                        <th class="w-8">Origin</th>
                                        <th class="w-8">Destination</th>
                                        <th>Commodity</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <tr class="baris">
                                        <td class="nomor-urut text-end">1.</td>
                                        <td>
                                            <input type="text" name="awb[]" id="awb[]" class="form-control" placeholder="Enter awb number..." required>
                                        </td>
                                        <td>
                                            <input type="text" name="origin[]" id="origin[]" class="form-control" placeholder="Enter origin..." oninput="this.value = this.value.toUpperCase()" required>
                                        </td>
                                        <td>
                                            <input type="text" name="destination[]" id="destination[]" class="form-control" placeholder="Enter destination..." oninput="this.value = this.value.toUpperCase()" required>
                                        </td>
                                        <td>
                                            <input type="text" name="commodity[]" id="commodity[]" class="form-control" placeholder="Enter commodity..." oninput="this.value = this.value.toUpperCase()" required>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger hapusRow">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <div class="d-flex">
                            <button type="button" class="btn btn-secondary" id="addRow">Add new row</button>
                            <button type="submit" class="btn btn-primary ms-auto">
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
        $('.uang').mask('000.000.000.000.000', {
            reverse: true
        });

        // Inisialisasi row
        var rowCount = 1;

        function updateRowNumbers() {
            $('#table-body .baris').each(function(index) {
                $(this).find('.nomor-urut').text(index + 1);
            });
        }
        updateRowNumbers();

        // Menambahkan baris baru ketika tombol 'addRow' diklik
        $('#addRow').on('click', function() {
            // Cek apakah ada input kosong di baris sebelumnya
            var previousRow = $('.baris').last();
            var isEmpty = false;

            previousRow.find('input[type="text"]').each(function() {
                if ($(this).val().trim() === '') {
                    isEmpty = true;
                    return false; // Berhenti iterasi jika ditemukan input kosong
                }
            });

            if (isEmpty) {
                Swal.fire({
                    icon: 'warning',
                    type: 'error',
                    title: 'Oops...',
                    text: 'Mohon isi semua input pada baris sebelumnya terlebih dahulu!',
                });
                return;
            }

            // Clone baris terakhir dan kosongkan input
            var newRow = previousRow.clone().find('input').val('').end();
            // newRow.find('.selectpicker').selectpicker('refresh');


            // Ganti ID elemen yang di-clone jika diperlukan
            newRow.find('input').each(function() {
                var name = $(this).attr('name');
                $(this).attr('id', name + rowCount); // Mengganti ID
            });

            rowCount++;
            previousRow.after(newRow);
            // initializeAutocomplete();
            updateRowNumbers();
        });

        // Hapus baris ketika tombol hapus diklik
        $(document).on('click', '.hapusRow', function() {
            if ($('.baris').length > 1) {
                $(this).closest('tr.baris').remove();
                updateRowNumbers();
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Baris tidak bisa dihapus, harus ada minimal satu baris.',
                });
            }
        });
    });
</script>