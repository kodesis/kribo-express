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
                    <a href="<?= base_url('booking/create_booking') ?>" class="btn btn-primary d-none d-sm-inline-block" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        Add new</a>
                    <a href="<?= base_url('booking/create_booking') ?>" class="btn btn-primary d-sm-none btn-icon" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
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
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <thead>
                                <tr>
                                    <th class="w-1">#</th>
                                    <th class="">Booking Code</th>
                                    <th class="">AWB</th>
                                    <th>Customer</th>
                                    <th class="w-1">Origin</th>
                                    <th class="w-1">Destination</th>
                                    <th>Commodity</th>
                                    <th>Receipt</th>
                                    <th class=""></th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($bookings) {
                                    $no = 1;

                                    foreach ($bookings as $b) :

                                        $count_detail = $this->db->like('slug', $b->no_booking, 'after')->get('awb_detail')->num_rows(); ?>

                                        <tr>
                                            <td class="text-end"><?= $no++; ?>.</td>
                                            <td><?= $b->no_booking ?></td>
                                            <td><?= ($b->awb && $b->awb != '-') ? $b->awb : "<button type='button' class='btn btn-primary btn-sm update-awb' data-id='$b->no_booking'>Belum diisi</button>" ?></td>
                                            <td><?= $b->nama_customer ?></td>
                                            <td><?= $b->origin ?></td>
                                            <td><?= $b->destination ?></td>
                                            <td><?= $b->commodity ?></td>
                                            <td><?= $count_detail ?></td>
                                            <td class="">
                                                <a href="<?= base_url('booking/print_invoice/') . $b->no_booking ?>" class="btn btn-success btn-sm ms-auto <?= ($count_detail > 0) ? '' : "disabled"; ?>" target="_blank">Invoice</a>
                                                <a href="<?= base_url('booking/detailBooking/') . $b->no_booking ?>" class="btn btn-primary btn-sm ms-auto">Detail</a>
                                                <button href="#" class="btn btn-danger btn-sm ms-auto">Delete</button>
                                            </td>
                                            <td>
                                                <?php
                                                if ($b->set_pickup == '0') {
                                                ?>
                                                    <button type="button" class="btn btn-primary btn-sm set-pickup <?= ($b->set_pickup == '0' && $count_detail > 0) ? '' : "disabled"; ?>" data-id="<?= $b->no_booking ?>"><?= ($count_detail > 0) ? 'Set pickup' : 'Resi belum ada' ?></button>
                                                    <?php
                                                } else {
                                                    if ($b->confirm_warehouse == '0') {
                                                    ?>
                                                        <button type="button" class="btn btn-warning btn-sm arr-warehouse <?= ($count_detail > 0) ? '' : 'disabled' ?>" data-id="<?= $b->no_booking ?>">Confirmation of arrival at warehouse</button>
                                                <?php
                                                    }
                                                } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7">Tidak ada data yang ditampilkan.</td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal pickup -->
<div class="modal modal-blur fade" id="setPickup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '.set-pickup', function() {
            var id = $(this).data('id');

            $('#setPickup .modal-title').text('Set pickup barang ' + id);

            $.ajax({
                url: "<?= site_url('booking/formPickup') ?>",
                type: "POST",
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#setPickup .modal-body').html(data);
                    $('#setPickup').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        title: "Error!! ",
                        text: 'Gagal mengambil data',
                        type: "error",
                        icon: "error",
                    });
                }
            });
        });

        $(document).on('click', '.arr-warehouse', function() {
            var id = $(this).data('id');

            $('#setPickup .modal-title').text('Confirm arrival at warehouse ' + id);

            $.ajax({
                url: "<?= site_url('booking/formConfirmWarehouse') ?>",
                type: "POST",
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#setPickup .modal-body').html(data);
                    $('#setPickup').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        title: "Error!! ",
                        text: 'Gagal mengambil data',
                        type: "error",
                        icon: "error",
                    });
                }
            });
        });

        $(document).on('click', '.update-awb', function() {
            var id = $(this).data('id');

            console.log(id)

            $('#setPickup .modal-title').text('Update AWB ' + id);

            $.ajax({
                url: "<?= site_url('booking/formInputAwb') ?>",
                type: "POST",
                data: {
                    id: id,
                },
                success: function(data) {
                    $('#setPickup .modal-body').html(data);
                    $('#setPickup').modal('show');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire({
                        title: "Error!! ",
                        text: 'Gagal mengambil data',
                        type: "error",
                        icon: "error",
                    });
                }
            });
        });
    });
</script>