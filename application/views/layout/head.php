<?php
//loading konfigurasi website

$site = $this->konfigurasi_model->listing();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $title ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->


	<!-- icon diambil dari website -->
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/upload/image/'.$site->icon) ?>" />
	<!-- seo google -->

	<meta name="keywords" content="<?php echo $site->keywords ?>">
	<meta name="description" content="<?php echo $title ?>, <?php echo $site->deskripsi ?>">

	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url() ?>assets/template/vendor/bootstrap/css/bootstrap.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url() ?>assets/template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/fonts/themify/themify-icons.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url() ?>assets/template/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url() ?>assets/template/fonts/elegant-font/html-css/style.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url() ?>assets/template/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url() ?>assets/template/vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url() ?>assets/template/vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/vendor/slick/slick.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css"
		href="<?php echo base_url() ?>assets/template/vendor/lightbox2/css/lightbox.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/css/main.css">
	<!--===============================================================================================-->

	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url()?>assets/admin/plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?= base_url()?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url()?>assets/admin/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<style type="text/css">
		.t-cart {
			font-family: Montserrat-Regular, sans-serif;
			font-size: 11pt;
		}

		.pagination a,
		.pagination b {

			padding: 10px 20px;
			background-color: blue;
			color: white;
			text-decoration: none;
			float: left;
		}

		.pagination a {
			background-color: blue;

		}

		.pagination a:hover {

			background-color: yellow;
		}



		.pagination a:hover {

			background-color: yellow;
		}
	</style>
</head>

<body class="animsition">