<form method="POST" action="<?= base_url('registration') ?>" autocomplete="off">
    <div class="card-body">
        <div class="row mb-4">
            <div class="d-flex align-items-center">
                <i class="flex-shrink-0 bg-primary p-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-square-rounded-number-1">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm.994 5.886c-.083 -.777 -1.008 -1.16 -1.617 -.67l-.084 .077l-2 2l-.083 .094a1 1 0 0 0 0 1.226l.083 .094l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l.293 -.293v5.586l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-8l-.006 -.114z" />
                    </svg>
                </i>
                <div class="ps-4">
                    <h1 class="text-primary m-0">Data diri</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-12 mb-3">
                <label for="nama_pendaftar" class="form-label">Nama pendaftar</label>
                <input type="text" name="nama_pendaftar" id="nama_pendaftar" class="form-control" placeholder="Nama pendaftar..." autocomplete="off" value="<?= $reg['nama_pendaftar'] ?>" readonly>
                <?= form_error('nama_pendaftar', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-4 col-12 mb-3">
                <label for="no_handphone" class="form-label">No. Handphone</label>
                <input type="text" name="no_handphone" id="no_handphone" class="form-control" placeholder="Nomor telepon..." autocomplete="off" value="<?= $reg['no_handphone'] ?>" readonly>
                <?= form_error('no_handphone', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-4 col-12 mb-3">
                <label for="no_handphone_alternatif" class="form-label">No. Handphone 2</label>
                <input type="text" name="no_handphone_alternatif" id="no_handphone_alternatif" class="form-control" placeholder="Nomor telepon..." autocomplete="off" value="<?= $reg['no_handphone_alternatif'] ?>" readonly>
                <?= form_error('no_handphone_alternatif', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-4 col-12 mb-3">
                <label for="alamat_email" class="form-label">Email</label>
                <input type="email" name="alamat_email" id="alamat_email" class="form-control" placeholder="Email..." autocomplete="off" value="<?= $reg['alamat_email'] ?>" readonly>
                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                <div class="invalid-feedback">Email sudah terdaftar</div>
                <div class="valid-feedback">Email bisa digunakan</div>
            </div>
            <div class="col-md-8 col-12 mb-3">
                <label for="sumber_info" class="form-label">Info pendaftaran</label>
                <input type="text" name="sumber_info" id="sumber_info" class="form-control" placeholder="Nomor telepon..." autocomplete="off" value="<?= $reg['sumber_info'] ?>" readonly>
                <?= form_error('sumber_info', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="row mt-4 mb-4">
            <div class="d-flex align-items-center">
                <i class="flex-shrink-0 bg-primary p-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-square-rounded-number-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm1 5h-3l-.117 .007a1 1 0 0 0 0 1.986l.117 .007h3v2h-2l-.15 .005a2 2 0 0 0 -1.844 1.838l-.006 .157v2l.005 .15a2 2 0 0 0 1.838 1.844l.157 .006h3l.117 -.007a1 1 0 0 0 0 -1.986l-.117 -.007h-3v-2h2l.15 -.005a2 2 0 0 0 1.844 -1.838l.006 -.157v-2l-.005 -.15a2 2 0 0 0 -1.838 -1.844l-.157 -.006z" />
                    </svg>
                </i>
                <div class="ps-4">
                    <h1 class="text-primary m-0">Data lokasi agen</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-12 mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="form-control" placeholder="Lokasi..." autocomplete="off" value="<?= $reg['lokasi'] ?>" readonly>
                <?= form_error('lokasi', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="jenis_bangunan" class="form-label">Jenis bangunan</label>
                <input type="text" name="jenis_bangunan" id="jenis_bangunan" class="form-control" placeholder="Jenis bangunan..." autocomplete="off" value="<?= $reg['jenis_bangunan'] ?>" readonly>
                <?= form_error('jenis_bangunan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="status_bangunan" class="form-label">Status bangunan</label>
                <input type="text" name="status_bangunan" id="status_bangunan" class="form-control" placeholder="Status bangunan..." autocomplete="off" value="<?= $reg['status_bangunan'] ?>" readonly>
                <?= form_error('status_bangunan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="usaha_lain" class="form-label">Usaha lain</label>
                <input type="text" name="usaha_lain" id="usaha_lain" class="form-control" placeholder="Usaha lain..." autocomplete="off" value="<?= $reg['usaha_lain'] ?>" readonly>
                <?= form_error('usaha_lain', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="provinsi" class="form-label">Provinsi</label>
                <input type="text" name="provinsi" id="provinsi" class="form-control" placeholder="Provinsi..." autocomplete="off" value="<?= $reg['provinsi'] ?>" readonly>
                <?= form_error('provinsi', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="kota" class="form-label">Kota/Kabupaten</label>
                <input type="text" name="kota" id="kota" class="form-control" placeholder="Kota/Kabupaten..." autocomplete="off" value="<?= $reg['kota'] ?>" readonly>
                <?= form_error('kota', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Kecamatan..." autocomplete="off" value="<?= $reg['kecamatan'] ?>" readonly>
                <?= form_error('kecamatan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="kelurahan" class="form-label">Kelurahan</label>
                <input type="text" name="kelurahan" id="kelurahan" class="form-control" placeholder="Kelurahan..." autocomplete="off" value="<?= $reg['kelurahan'] ?>" readonly>
                <?= form_error('kelurahan', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="alamat_lengkap" class="form-label">Alamat lengkap</label>
                <textarea type="text" name="alamat_lengkap" id="alamat_lengkap" class="form-control" placeholder="Alamat lengkap..." autocomplete="off" rows="3" readonly><?= $reg['alamat_lengkap'] ?></textarea>
                <?= form_error('alamat_lengkap', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="col-md-6 col-12 mb-3">
                <label for="google_maps" class="form-label">Google Maps URL</label>
                <textarea type="text" name="google_maps" id="google_maps" class="form-control" placeholder="Nama lengkap..." autocomplete="off" rows="3" readonly><?= $reg['google_maps'] ?></textarea>
                <?= form_error('google_maps', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="row mb-4">
            <div class="d-flex align-items-center">
                <i class="flex-shrink-0 bg-primary p-3 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-square-rounded-number-3">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 2l.642 .005l.616 .017l.299 .013l.579 .034l.553 .046c4.687 .455 6.65 2.333 7.166 6.906l.03 .29l.046 .553l.041 .727l.006 .15l.017 .617l.005 .642l-.005 .642l-.017 .616l-.013 .299l-.034 .579l-.046 .553c-.455 4.687 -2.333 6.65 -6.906 7.166l-.29 .03l-.553 .046l-.727 .041l-.15 .006l-.617 .017l-.642 .005l-.642 -.005l-.616 -.017l-.299 -.013l-.579 -.034l-.553 -.046c-4.687 -.455 -6.65 -2.333 -7.166 -6.906l-.03 -.29l-.046 -.553l-.041 -.727l-.006 -.15l-.017 -.617l-.004 -.318v-.648l.004 -.318l.017 -.616l.013 -.299l.034 -.579l.046 -.553c.455 -4.687 2.333 -6.65 6.906 -7.166l.29 -.03l.553 -.046l.727 -.041l.15 -.006l.617 -.017c.21 -.003 .424 -.005 .642 -.005zm1 5h-2l-.15 .005a2 2 0 0 0 -1.85 1.995a1 1 0 0 0 1.974 .23l.02 -.113l.006 -.117h2v2h-2l-.133 .007c-1.111 .12 -1.154 1.73 -.128 1.965l.128 .021l.133 .007h2v2h-2l-.007 -.117a1 1 0 0 0 -1.993 .117a2 2 0 0 0 1.85 1.995l.15 .005h2l.15 -.005a2 2 0 0 0 1.844 -1.838l.006 -.157v-2l-.005 -.15a1.988 1.988 0 0 0 -.17 -.667l-.075 -.152l-.019 -.032l.02 -.03a2.01 2.01 0 0 0 .242 -.795l.007 -.174v-2l-.005 -.15a2 2 0 0 0 -1.838 -1.844l-.157 -.006z" />
                    </svg>
                </i>
                <div class="ps-4">
                    <h3 class="text-primary m-0">Dokumen pendukung</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <div class="d-flex">
            <a href="<?= base_url('home') ?>" type="button" class="btn btn-warning ms-auto">Kembali</a>
            <button type="submit" class="btn btn-primary btn-submit ms-1">
                Simpan
            </button>
        </div>
    </div>
</form>