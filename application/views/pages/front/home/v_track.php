<!-- Page Header Start -->
<div class="container-fluid page-header py-5">
	<div class="container py-5">
		<h1 class="display-3 text-white mb-3 animated slideInDown">Lacak Kiriman Anda</h1>
		<nav aria-label="breadcrumb animated slideInDown">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a class="text-white" href="<?= base_url() ?>">Home</a></li>
				<li class="breadcrumb-item text-white active" aria-current="page">Track Resi</li>
			</ol>
		</nav>
	</div>
</div>
<!-- Page Header End -->

<!-- Track Resi Section Start -->
<div class="container-xxl py-5">
	<div class="container py-5">
		<div class="row g-5 align-items-center">
			<div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
				<h6 class="text-secondary text-uppercase mb-3">Kribo Express - Kirim Bro</h6>
				<h1 class="mb-4">Lacak Kiriman Anda dengan Mudah</h1>
				<p class="mb-4"> Di Kribo Express, kami memahami betapa pentingnya mengetahui posisi paket Anda. Gunakan fitur lacak resi kami untuk mengetahui status pengiriman Anda dalam hitungan detik. Cukup masukkan nomor resi dan dapatkan informasi real-time tentang perjalanan paket Anda. </p>
				<p class="mb-4">Dengan Kribo Express, paket Anda selalu dalam genggaman. Kirim Bro, Lacak Bro!</p>
			</div>
			<div class="col-lg-6">
				<div class="bg-light text-center p-5 wow fadeIn" data-wow-delay="0.5s">
					<form method="POST" action="<?= base_url('home/track') ?>">
						<div class="row g-3">
							<div class="col-12">
								<input type="text" name="nomor_resi" id="nomor_resi" class="form-control border-0" placeholder="Masukkan Nomor Resi" style="height: 55px;" value="<?= $this->input->post('nomor_resi') ?>" required>
							</div>
							<div class="col-12">
								<!-- Google reCAPTCHA v2 widget -->
								<div class="g-recaptcha" data-sitekey="6Le8ZkcqAAAAAMaPLJPvTfEmiAJxPdh-wBXJmoma"></div>
							</div>
							<div class="col-12">
								<button class="btn btn-primary w-100 py-3" type="submit">Lacak Sekarang</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	<div class="container py-5">
		<?php if ($this->session->flashdata('message')) : ?>
			<div class="row g-5 mb-5">

				<div class="alert alert-info">
					<?php echo $this->session->flashdata('message'); ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="row g-5 text-center">
			<?php
			if ($resi) {
			?>
				<ul class="bs4-order-tracking-2">
					<?php
					?>
					<li class="step <?= ($resi['status_tracking'] == '0') ? 'active' : '' ?>">
						<div style="margin-bottom: 10px;"><i class="fa fa-clipboard-list fa-2x"></i></div>
						Dalam proses
						<p class="text-center fst-italic mt-0">In Process</p>
					</li>
					<li class="step <?= ($resi['status_tracking'] == '1') ? 'active' : '' ?>">
						<div style="margin-bottom: 10px;"><i class="fa fa-dolly fa-2x"></i></div> Penjemputan
						<p class="text-center fst-italic mt-0">Pickup</p>
					</li>
					<li class="step <?= ($resi['status_tracking'] == '2') ? 'active' : '' ?>">
						<div style="margin-bottom: 10px;"><i class="fa fa-shipping-fast fa-2x"></i></div> Perjalanan ke gudang
						<p class="text-center fst-italic mt-0">In delivery to warehouse</p>
					</li>
					<li class="step <?= ($resi['status_tracking'] == '3') ? 'active' : '' ?>">
						<div style="margin-bottom: 10px;"><i class="fa fa-warehouse fa-2x"></i></div> Tiba di <?= $booking['gudang_tujuan'] ?>
						<p class="text-center fst-italic mt-0">Arrived at <?= $booking['gudang_tujuan'] ?></p>
					</li>
					<li class="step <?= ($resi['status_tracking'] == '4') ? 'active' : '' ?>">
						<div style="margin-bottom: 10px;"><i class="fa fa-map-marker-alt fa-2x"></i></div> Tiba di tujuan (<?= $resi['kota_tujuan'] ?>)
						<p class="text-center fst-italic mt-0">Arrived at destination (<?= $resi['kota_tujuan'] ?>)</p>
					</li>
				</ul>
				<?php
				if ($resi['status_tracking'] == '3') {
				?>
					<p class="text-center">Paket akan dikirimkan dengan <?= ucfirst($resi['moda_pengiriman']) ?> pada <?= format_indo($resi['tanggal_berangkat']) ?> dari <?= $booking['origin'] ?> menuju <?= $booking['destination'] ?></p>
					<p class="text-center fst-italic mt-0">
						The package will be shipped by <?= ucfirst($resi['moda_pengiriman']) ?> on <?= format_english($resi['tanggal_berangkat']) ?> from CGK to KNO.</p>
				<?php
				} else if ($resi['status_tracking'] == '2') {
				?>
					<p class="text-center">Paket sedang dalam pengantaran ke <?= $booking['gudang_tujuan'] ?> oleh <?= $driver['name'] ?>. <br>
					<p class="text-center fst-italic mt-0">The package is currently being delivered to <?= $booking['gudang_tujuan'] ?> by <?= $driver['name'] ?>.</p>
				<?php
				} ?>
			<?php
			}
			?>
		</div>
	</div>
</div>
<!-- Track Resi Section End -->

<!-- Google reCAPTCHA v2 Script -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>