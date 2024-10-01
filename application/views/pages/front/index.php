<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title><?= $title ?> | Kribo Express - Kirim Bro</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">

	<link href="<?= base_url() ?>assets/logo/icon-kribo-express.png" rel="icon">

	<!-- Google Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

	<!-- Icon Font Stylesheet -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

	<!-- Libraries Stylesheet -->
	<link href="<?= base_url() ?>assets/front/lib/animate/animate.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/front/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

	<!-- Customized Bootstrap Stylesheet -->
	<link href="<?= base_url() ?>assets/front/css/bootstrap.min.css" rel="stylesheet">

	<!-- Template Stylesheet -->
	<link href="<?= base_url() ?>assets/front/css/style.css" rel="stylesheet">
	<style>
		.bs4-order-tracking-2 {
			margin-bottom: 30px;
			overflow: hidden;
			color: #878788;
			padding-left: 0px;
			margin-top: 30px
		}

		.bs4-order-tracking-2 li {
			list-style-type: none;
			font-size: 13px;
			width: 20%;
			float: left;
			position: relative;
			font-weight: 400;
			color: #878788;
			text-align: center;
		}

		.bs4-order-tracking-2 li:first-child:before {
			margin-left: 15px !important;
			padding-left: 11px !important;
			text-align: left !important
		}

		.bs4-order-tracking-2 li:last-child:before {
			margin-right: 5px !important;
			padding-right: 11px !important;
			text-align: right !important
		}

		.bs4-order-tracking-2 li>div {
			color: #fff;
			width: 80px;
			text-align: center;
			line-height: 80px;
			display: block;
			font-size: 12px;
			background: #878788;
			border-radius: 50%;
			margin: auto
		}

		.bs4-order-tracking-2 li:after {
			content: '';
			width: 150%;
			height: 2px;
			background: #878788;
			position: absolute;
			left: 0%;
			right: 0%;
			z-index: -1;
			/* mengatur posisi ketinggian baris */
			top: 30%;
		}

		.bs4-order-tracking-2 li:first-child:after {
			left: 50%
		}

		.bs4-order-tracking-2 li:last-child:after {
			left: 0% !important;
			width: 0% !important
		}

		.bs4-order-tracking-2 li.active {
			font-weight: bold;
			color: #fe0a26
		}

		.bs4-order-tracking-2 li.active>div {
			background: #fe0a26
		}

		.bs4-order-tracking-2 li.active:after {
			background: #fe0a26
		}
	</style>
</head>

<body>
	<!-- Spinner Start -->
	<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
		<div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	<!-- Spinner End -->


	<!-- Navbar Start -->
	<nav class="navbar navbar-expand-lg bg-white navbar-light shadow border-top border-5 border-primary sticky-top p-0">
		<a href="<?= base_url() ?>" class="navbar-brand  d-flex align-items-center px-4 px-lg-5">
			<!-- <h2 class="mb-2 text-white">Kribo Express</h2> -->
			<img src="<?= base_url('assets/logo/logo-02.png') ?>" alt="" class="w-20">
		</a>
		<button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav ms-auto p-4 p-lg-0">
				<a href="<?= base_url() ?>" class="nav-item nav-link <?= ($segment == 'home') ? 'active' : '' ?>">Beranda</a>
				<a href="<?= base_url('home/about') ?>" class="nav-item nav-link <?= ($segment == 'about') ? 'active' : '' ?>">Tentang</a>
				<a href="<?= base_url('home/service') ?>" class="nav-item nav-link <?= ($segment == 'service') ? 'active' : '' ?>">Layanan</a>
				<a href="<?= base_url('home/track') ?>" class="nav-item nav-link <?= ($segment == 'track') ? 'active' : '' ?>">Cek&nbsp;Resi</a>
				<a href="<?= base_url('auth') ?>" class="nav-item nav-link"><?= ($this->session->userdata('user_id')) ? 'Dashboard' : 'Login' ?></a>
			</div>
			<!-- <h4 class="m-0 pe-lg-5 d-none d-lg-block"><i class="fa fa-headphones text-primary me-3"></i>+012 345 6789</h4> -->
		</div>
	</nav>
	<!-- Navbar End -->


	<?php $this->load->view($pages) ?>


	<!-- Footer Start -->
	<div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s" style="margin-top: 6rem;">
		<div class="container py-5">
			<div class="row g-5">
				<div class="col-lg-4 col-md-6">
					<h4 class="text-light mb-4">Address</h4>
					<p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Andara Raya No.1 A, Pondok Labu, Kec. Cilandak, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12450</p>
					<p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
					<p class="mb-2"><i class="fa fa-envelope me-3"></i>admin@kriboexpress.com</p>
					<div class="d-flex pt-2">
						<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
						<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
						<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
						<a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<h4 class="text-light mb-4">Services</h4>
					<a class="btn btn-link" href="">Air Freight</a>
					<a class="btn btn-link" href="">Sea Freight</a>
					<a class="btn btn-link" href="">Road Freight</a>
					<a class="btn btn-link" href="">Logistic Solutions</a>
					<a class="btn btn-link" href="">Industry solutions</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<h4 class="text-light mb-4">Quick Links</h4>
					<a class="btn btn-link" href="">Tentang</a>
					<a class="btn btn-link" href="">Layanan</a>
					<a class="btn btn-link" href="">Cek Resi</a>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="copyright">
				<div class="row">
					<div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
						Copyright &copy; <?= date('Y') ?> <a class="" href="<?= base_url() ?>">Kribo Express</a>, All Right Reserved.
					</div>
					<div class="col-md-6 text-center text-md-end">
						<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
						Designed By <a class="" href="https://htmlcodex.com">HTML Codex</a>
						</br>Distributed By <a class="" href="https://themewagon.com" target="_blank">ThemeWagon</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer End -->


	<!-- Back to Top -->
	<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i class="bi bi-arrow-up"></i></a>


	<!-- JavaScript Libraries -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>assets/front/lib/wow/wow.min.js"></script>
	<script src="<?= base_url() ?>assets/front/lib/easing/easing.min.js"></script>
	<script src="<?= base_url() ?>assets/front/lib/waypoints/waypoints.min.js"></script>
	<script src="<?= base_url() ?>assets/front/lib/counterup/counterup.min.js"></script>
	<script src="<?= base_url() ?>assets/front/lib/owlcarousel/owl.carousel.min.js"></script>

	<!-- Template Javascript -->
	<script src="<?= base_url() ?>assets/front/js/main.js"></script>
</body>

</html>