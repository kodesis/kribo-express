<div class="card-body">
    <h2 class="h2 text-center mb-4"><?= $title ?></h2>

    <?= $this->session->flashdata('message_name'); ?>

    <?php
    if ($status == '1') {
    ?>
        <form method="POST" action="<?= base_url('confirm/finishDelivery') ?>" autocomplete="off" novalidate enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="resi" class="form-label">No. Resi</label>
                        <input type="text" name="resi" id="resi" class="form-control" value="<?= $resi['slug'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="resi" class="form-label">Jenis barang</label>
                        <input type="text" name="resi" id="resi" class="form-control" value="<?= $commodity ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="resi" class="form-label">Qty</label>
                        <input type="text" name="resi" id="resi" class="form-control" value="<?= $resi['qty'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-3">
                        <label for="resi" class="form-label">Chargeable</label>
                        <input type="text" name="resi" id="resi" class="form-control" value="<?= $resi['chargeable'] ?>" readonly>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="mb-3">
                        <label for="resi" class="form-label">Agent</label>
                        <input type="text" name="resi" id="resi" class="form-control" value="<?= $agent ?>" readonly>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="mb-3">
                        <label for="resi" class="form-label">Alamat</label>
                        <input type="text" name="resi" id="resi" class="form-control" value="<?= $resi['kota_tujuan'] ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Bukti foto</label>
                <input type="file" name="file_upload" id="file_upload" class="form-control">
                <?= form_error('file_upload', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn btn-primary btn-submit w-100">Submit</button>
            </div>
        </form>
    <?php
    } ?>

</div>