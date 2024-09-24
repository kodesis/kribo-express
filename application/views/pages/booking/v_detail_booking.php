<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    <?= $title ?>
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
                <form action="<?= base_url('booking/simpanDetailAwb/') . $awb['Id'] ?>" method="post" class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="awb_num" class="form-label">AWB</label>
                                    <input type="text" name="awb_num" id="awb_num" class="form-control" value="<?= $awb['awb'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label">Customer</label>
                                    <select class="form-select" name="customer_id" id="customer_id" required>
                                        <option value="">:: Pilih customer</option>
                                        <?php
                                        foreach ($customers as $c) :
                                        ?>
                                            <option <?= ($awb['customer_id'] == $c->id) ? 'selected' : '' ?> value="<?= $c->id ?>"><?= $c->nama_customer ?></option>
                                        <?php
                                        endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="mb-3">
                                    <label for="commodity" class="form-label">Commodity</label>
                                    <input type="text" name="commodity" id="commodity" class="form-control" value="<?= $awb['commodity'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-2">
                                    <label for="origin" class="form-label">Origin</label>
                                    <input type="text" name="origin" id="origin" class="form-control" value="<?= $awb['origin'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-3">
                                    <label for="destination" class="form-label">Destination</label>
                                    <input type="text" name="destination" id="destination" class="form-control" value="<?= $awb['destination'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-3">
                                    <label for="total_qty" class="form-label">Total qty</label>
                                    <input type="text" name="total_qty" id="total_qty" class="form-control" value="<?= $awb['total_qty'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-3">
                                    <label for="total_chargeable" class="form-label">Total chargeable</label>
                                    <input type="text" name="total_chargeable" id="total_chargeable" class="form-control" value="<?= $awb['total_chargeable'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-3">
                                    <label for="subtotal" class="form-label">Subtotal</label>
                                    <input type="text" name="subtotal" id="subtotal" class="form-control" value="<?= $awb['subtotal'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="w-8">#</th>
                                        <th class="w-8">Qty</th>
                                        <th class="w-8">Chargeable</th>
                                        <th>City of destination</th>
                                        <th class="w-8">Nominal</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <?php
                                    if ($details) {
                                        foreach ($details as $d) : ?>
                                            <tr class="baris">
                                                <td class="text-end">
                                                    <input type="hidden" name="status_tracking[]" id="status_tracking[]" readonly value="<?= $d->status_tracking ?>">
                                                    <input type="text" name="nomor_urut[]" id="nomor_urut[]" class="form-control nomor-urut" readonly value="<?= $d->no_urut ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="qty[]" id="qty[]" class="form-control angka" placeholder="Enter qty number..." required value="<?= $d->qty ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="chargeable[]" id="chargeable[]" class="form-control angka" placeholder="Enter chargeable..." oninput="this.value = this.value.toUpperCase()" required value="<?= $d->chargeable ?>">
                                                </td>
                                                <td>
                                                    <textarea type="text" name="kota_tujuan[]" id="kota_tujuan[]" class="form-control" placeholder="Enter city of destination..." oninput="this.value = this.value.toUpperCase()" rows="1" required><?= $d->kota_tujuan ?></textarea>
                                                </td>
                                                <td>
                                                    <input type="text" name="nominal[]" id="nominal[]" class="form-control angka" placeholder="Enter nominal..." oninput="this.value = this.value.toUpperCase()" required value="<?= number_format($d->nominal) ?>">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger hapusRow">Hapus</button>
                                                </td>
                                            </tr>
                                    <?php
                                        endforeach;
                                    } ?>
                                    <tr class="baris">
                                        <td class="text-end">
                                            <input type="text" name="nomor_urut[]" id="nomor_urut[]" class="form-control nomor-urut" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="qty[]" id="qty[]" class="form-control angka" placeholder="Enter qty number..." required>
                                        </td>
                                        <td>
                                            <input type="text" name="chargeable[]" id="chargeable[]" class="form-control angka" placeholder="Enter chargeable..." oninput="this.value = this.value.toUpperCase()" required>
                                        </td>
                                        <td>
                                            <textarea type="text" name="kota_tujuan[]" id="kota_tujuan[]" class="form-control" placeholder="Enter city of destination..." oninput="this.value = this.value.toUpperCase()" rows="1" required></textarea>
                                        </td>
                                        <td>
                                            <input type="text" name="nominal[]" id="nominal[]" class="form-control angka" placeholder="Enter nominal..." oninput="this.value = this.value.toUpperCase()" required>
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
                            <button type="submit" class="btn btn-primary ms-auto btn-submit-detail">
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

<script>
    $(document).ready(function() {
        // Menggunakan mask untuk input uang
        $('.angka').mask('000.000.000.000.000', {
            reverse: true
        });

        // Inisialisasi row
        var rowCount = 1;

        function updateRowNumbers() {
            $('#table-body .baris').each(function(index) {
                var number = index + 1;
                $(this).find('.nomor-urut').val(number.toString().padStart(2, '0'));
            });
        }

        updateRowNumbers();
        updateTotal();

        // Menambahkan baris baru ketika tombol 'addRow' diklik
        $('#addRow').on('click', function() {
            var totalQty = parseFloat($('#total_qty').val().replace(/\./g, ''));

            // Cek apakah total qty sudah mencapai 15
            if (totalQty >= 15) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Total Qty Mencapai 15',
                    text: 'Anda tidak bisa menambahkan baris baru karena total qty sudah mencapai 15.'
                });
                $(this).prop('disabled', true);
                return;
            }

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
            var newRow = previousRow.clone();
            newRow.find('input').val(''); // Kosongkan input
            newRow.find('textarea').val(''); // Kosongkan textarea

            // Ganti ID elemen yang di-clone jika diperlukan
            newRow.find('input').each(function() {
                var name = $(this).attr('name');
                $(this).attr('id', name + rowCount); // Mengganti ID
            });

            rowCount++;
            previousRow.after(newRow);
            updateRowNumbers();
            updateTotal();

            newRow.find('.angka').mask('000.000.000.000.000', {
                reverse: true
            });
        });

        // Hapus baris ketika tombol hapus diklik
        $(document).on('click', '.hapusRow', function() {
            if ($('.baris').length > 1) {
                $(this).closest('tr.baris').remove();
                updateRowNumbers();
                updateTotal();
            } else {
                Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Baris tidak bisa dihapus, harus ada minimal satu baris.',
                });
            }
        });

        // Update total qty ketika ada perubahan nilai di input qty
        $(document).on('input', 'input[name="qty[]"], input[name="chargeable[]"], input[name="nominal[]"]', function() {
            var total_qty = 0;
            var max_qty = 15; // Batas maksimum total qty

            // Hitung total qty saat ini dari semua baris
            $(".baris").each(function() {
                var qty = $(this).find('input[name="qty[]"]').val().replace(/\./g, '');
                qty = parseFloat(qty.replace(/,/g, ''));
                if (!isNaN(qty)) {
                    total_qty += qty;
                }
            });

            // Dapatkan nilai yang diinput pada baris ini
            var input_qty = parseFloat($(this).val().replace(/,/g, ''));

            // Periksa apakah total_qty melebihi batas maksimum
            if (total_qty > max_qty) {
                var sisa_qty = max_qty - (total_qty - input_qty); // Hitung sisa yang diperbolehkan
                $(this).val(sisa_qty); // Sesuaikan input qty ke nilai sisa yang diizinkan
                Swal.fire({
                    icon: 'warning',
                    title: 'Melebihi Batas',
                    text: 'Total qty tidak boleh melebihi 15. Kuota yang tersisa hanya ' + sisa_qty + '.'
                });
            }
            updateTotal();
        });

        function formatNumber(number) {
            // Pisahkan bagian integer dan desimal
            let parts = number.toString().split(".");

            // Format bagian integer dengan pemisah ribuan
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // Gabungkan bagian integer dan desimal dengan koma sebagai pemisah desimal
            return parts.join(",");
        }

        function updateTotal() {
            var total_qty = 0;
            var total_chargeable = 0;
            var subtotal = 0;
            // var ppn = 0;
            // var grandtotal = 0;

            $(".baris").each(function() {
                var qty = $(this).find('input[name="qty[]"]').val().replace(/\./g, '');
                var chargeable = $(this).find('input[name="chargeable[]"]').val().replace(/\./g, '');
                var nominal = $(this).find('input[name="nominal[]"]').val().replace(/\./g, '');

                qty = parseFloat(qty.replace(/,/g, ''));
                chargeable = parseFloat(chargeable.replace(/,/g, ''));
                nominal = parseFloat(nominal.replace(/,/g, ''));

                if (!isNaN(qty)) { // Pastikan qty adalah angka
                    total_qty += qty; // Tambahkan nilai qty ke total_qty
                }

                if (!isNaN(chargeable)) { // Pastikan chargeable adalah angka
                    total_chargeable += chargeable; // Tambahkan nilai chargeable ke total_chargeable
                }

                if (!isNaN(nominal)) { // Pastikan nominal adalah angka
                    subtotal += nominal; // Tambahkan nilai nominal ke total_nominal
                }
            });

            // ppn = subtotal * 0.11;
            // grandtotal = subtotal + ppn;

            $('#total_qty').val(formatNumber(total_qty));
            $('#total_chargeable').val(formatNumber(total_chargeable));
            $('#subtotal').val(formatNumber(subtotal));
            // $('#ppn').val(formatNumber(ppn));
            // $('#grandtotal').val(formatNumber(grandtotal));
        }
    });
</script>