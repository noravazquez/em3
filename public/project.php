<?php
require_once "../config/database.php";
require_once "../lib/projects_public.php";

$projects = getProjects($db);
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Em3 - Portafolio</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="56x56" href="assets/images/fav-icon/logo_em3.png">
	<!-- bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" media="all">
	<!-- carousel CSS -->
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css" media="all">
	<!-- animate CSS -->
	<link rel="stylesheet" href="assets/css/animate.css" type="text/css" media="all">
	<!-- animated-text CSS -->
	<link rel="stylesheet" href="assets/css/animated-text.css" type="text/css" media="all">
	<!-- font-awesome CSS -->
	<link rel="stylesheet" href="assets/css/all.min.css" type="text/css" media="all">
	<!-- font-flaticon CSS -->
	<link rel="stylesheet" href="assets/css/flaticon.css" type="text/css" media="all">
	<!-- theme-default CSS -->
	<link rel="stylesheet" href="assets/css/theme-default.css" type="text/css" media="all">
	<!-- meanmenu CSS -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css" type="text/css" media="all">
	<!-- Main Style CSS -->
	<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all">
	<!-- transitions CSS -->
	<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css" media="all">
	<link rel="stylesheet" href="assets/css/splide.min.css" type="text/css" media="all">
	<!-- venobox CSS -->
	<link rel="stylesheet" href="venobox/venobox.css" type="text/css" media="all">
	<!-- responsive CSS -->
	<link rel="stylesheet" href="assets/css/responsive.css" type="text/css" media="all">
	<!-- modernizr js -->
	<script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
	<!-- bootstrap icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body>
	<!-- loder -->
	<div class="loader-wrapper">
		<div class="loader"></div>
		<div class="loder-section left-section"></div>
		<div class="loder-section right-section"></div>
	</div>

	<!--==================================================-->
	<!-- Start solutek Main Menu Area -->
	<!--==================================================-->
	<div id="sticky-header" class="solutek_nav_manu">
		<div class="container-fluid">
			<div class="row d-flex align-items-center">
				<div class="col-lg-2">
					<div class="logo">
						<a class="logo_img" href="index.php" title="solutek">
							<img src="assets/images/logo_menu.svg" alt="logo">
						</a>
						<a class="main_sticky" href="index.php" title="solutek">
							<img src="assets/images/logo_menu.svg" alt="astute">
						</a>
					</div>
				</div>
				<div class="col-lg-8">
					<nav class="solutek_menu">
						<ul class="nav_scroll">
							<li><a href="index.php">Inicio</a></li>
							<li><a href="about-us.html">Sobre nosotros</a></li>
							<li><a href="project.html">Portafolio</a></li>
							<li><a href="service.html">Servicios</a></li>
							<li><a href="contact.html">Contacto</a></li>
						</ul>
					</nav>
				</div>
				<div class="col-lg-2">
					<div class="header-btn">
						<a href="login.php">Iniciar sesion <i class="bi bi-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- solutek Mobile Menu Area -->
	<div class="mobile-menu-area sticky d-sm-block d-md-block d-lg-none ">
		<div class="mobile-menu">
			<nav class="solutek_menu">
				<ul class="nav_scroll">
					<li><a href="index.php">Inicio</a></li>
					<li><a href="about-us.html">Sobre nosotros</a></li>
					<li><a href="project.html">Portafolio</a></li>
					<li><a href="service.html">Servicios</a></li>
					<li><a href="contact.html">Contacto</a></li>
					<li><a href="login.php">Iniciar sesion</a></li>
				</ul>
			</nav>
		</div>
	</div>
	<!--==================================================-->
	<!-- End solutek Main Menu Area -->
	<!--==================================================-->


	<!--==================================================-->
	<!-- Start Curser Section Here -->
	<!--==================================================-->
	<div class="curser"></div>
	<div class="curser2"></div>
	<!--==================================================-->
	<!-- Ends Curser Section Here -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start solutek breadcumb Area -->
	<!--==================================================-->
	<div class="breadcumb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="breadcumb-content">
						<h4>Portafolio</h4>
						<ul class="breadcumb-list">
							<li><a href="index.html">Inicio</a></li>
							<li class="list-arrow">&lt;</li>
							<li>Portafolio</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- end solutek breadcumb Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start solutek case-study-area -->
	<!--==================================================-->
	<div class="case-study-area">
		<div class="container">
			<div class="row case-study-bg">
				<div class="col-lg-12 col-sm-12">
					<div class="case_study_nav">
						<div class="case_study_menu">
							<div class="input-group">
								<span class="input-group-text"><i class="bi bi-search"></i></span>
								<input type="text" class="form-control" placeholder="Buscar proyectos..." id="searchInput">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row image_load projects">
				<?php foreach ($projects as $p): ?>
					<?php
					$images = getImagesByProject($db, $p['id_proyecto']);
					$thumbnail = !empty($images) ? "proyectos/" . $p['id_proyecto'] . "/" . $images[0]['nombre_archivo'] : "no-imagen.jpg";
					?>
					<div class="col-lg-6 col-sm-6 grid-item">
						<div class="case-study-single-box">
							<div class="case-study-thumb">
								<img src="admin/project_gallery/uploads/<?= htmlspecialchars($thumbnail); ?>" alt="<?= htmlspecialchars($p['nombre']); ?>">
							</div>
							<div class="case-study-content row">
								<div class="case-study-title col-10">
									<h3><?= htmlspecialchars($p['nombre']); ?></h3>
								</div>
								<div class="case-study-icon col-2">
									<a class="open-project" data-id="<?= $p['id_proyecto']; ?>"
										data-nombre="<?= htmlspecialchars($p['nombre']); ?>"
										data-descripcion="<?= htmlspecialchars($p['descripcion']); ?>"
										data-images='<?= json_encode($images); ?>'>
										<i class="bi bi-arrow-right"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<!-- Modal de detalle de proyecto -->
	<div class="modal fade" id="modal-project-details">
		<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="project-title">Título del Proyecto</h5>
					<button id="close-project" type="button" class="btn-close">
					</button>
					<!-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar"></button> -->
				</div>

				<div class="modal-body">
					<!-- Descripción -->
					<p id="project-description" class="text-muted mb-4">Descripción del proyecto...</p>

					<!-- Carrusel de imágenes -->
					<div id="project-carousel" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner" id="project-carousel-inner">
						</div>
						<a class="carousel-control-prev" href="#project-carousel" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon"></span>
							<span class="sr-only">Anterior</span>
						</a>
						<a class="carousel-control-next" href="#project-carousel" role="button" data-slide="next">
							<span class="carousel-control-next-icon"></span>
							<span class="sr-only">Siguiente</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--==================================================-->
	<!--End solutek case-study-area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start solutek address Area -->
	<!--==================================================-->
	<div class="address-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<div class="address-box">
						<div class="address-icon">
							<img src="assets/images/address1.png" alt="address1">
						</div>
						<div class="address-title">
							<h3>Elevating Customer Experience.</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="address-box2">
						<div class="address-icon">
							<img src="assets/images/address2.png" alt="address1">
						</div>
						<div class="solutek-btn">
							<a href="contact.html">+44 920 090 505
								<div class="solutek-hover-btn hover-bx"></div>
								<div class="solutek-hover-btn hover-bx2"></div>
								<div class="solutek-hover-btn hover-bx3"></div>
								<div class="solutek-hover-btn hover-bx4"></div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- end solutek address Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start solutek Footer Area -->
	<!--==================================================-->
	<div class="footer-area">
		<div class="container">
			<div class="row footer">
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="footer-widget">
						<div class="footer-logo">
							<a href="index.html"><img src="assets/images/footer-logo.png" alt="footer-logo"></a>
						</div>
						<p class="footer-widget-text">Globally monetize plug-and-play data it solu
							monotonectally disseminate oriented busine
							multifunctional mind design.</p>
						<div class="footer-social">
							<div class="footer-widget-social">
								<a href="#"><i class="fab fa-facebook-f"></i></a>
								<a href="#"><i class="fab fa-twitter"></i></a>
								<a href="#"><i class="fab fa-linkedin-in"></i></a>
								<a href="#"><i class="fab fa-pinterest-p"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="footer-widget left">
						<div class="widget-title">
							<h2>Useful Links</h2>
						</div>
						<ul>
							<li><a href="about-us.html">About Company</a></li>
							<li><a href="team.html">Meet Our Team</a></li>
							<li><a href="blog-grid.html">Latest Blog</a></li>
							<li><a href="contact.html">Contact Us</a></li>
							<li><a href="testimonial.html">Testimonials</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="footer-widget left">
						<div class="widget-title">
							<h2>Services.</h2>
						</div>
						<ul>
							<li><a href="about-us.html">About Company</a></li>
							<li><a href="team.html">Meet Our Team</a></li>
							<li><a href="blog-grid.html">Latest Blog</a></li>
							<li><a href="contact.html">Contact Us</a></li>
							<li><a href="faq.html">FAQ</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="footer-widget-newsletter">
						<div class="widget-title">
							<h2>Newsletter</h2>
						</div>
						<p class="newsletter-text">Globally monetize plug-and-play data it solu
							monotonectally disseminate oriented busine
							multifunctional mind design.</p>
						<div class="Subscribe-form2">
							<form>
								<div class="form-field2">
									<input type="email" name="EMAIL" placeholder="Enter Your E-mail" required="">
									<button class="subscribe-button" type="submit"><i class="bi bi-send"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row copyright">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="-copyright-text">
						<p>© Copyright 2024 By Solutek</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="copyright-list">
						<ul>
							<li><a href="index.html">Privacy Policy</a></li>
							<li><a href="index-2.html">Supports</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- end solutek Footer Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start scrollup section Area -->
	<!--==================================================-->
	<!-- scrollup section -->
	<div class="scroll-area">
		<div class="top-wrap">
			<div class="go-top-btn-wraper">
				<div class="go-top go-top-button">
					<i class="fas fa-arrow-up"></i>
					<i class="fas fa-arrow-up"></i>
				</div>
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- Start scrollup section Area -->
	<!--==================================================-->

	<!-- jquery js -->
	<script src="assets/js/vendor/jquery-3.6.2.min.js"></script>
	<!-- bootstrap js -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- carousel js -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- counterup js -->
	<script src="assets/js/jquery.counterup.min.js"></script>
	<!-- waypoints js -->
	<script src="assets/js/waypoints.min.js"></script>
	<!-- wow js -->
	<script src="assets/js/wow.js"></script>
	<!-- imagesloaded js -->
	<script src="assets/js/imagesloaded.pkgd.min.js"></script>
	<!-- venobox js -->
	<script src="venobox/venobox.js"></script>
	<!--  animated-text js -->
	<script src="assets/js/animated-text.js"></script>
	<!-- venobox min js -->
	<script src="venobox/venobox.min.js"></script>
	<!-- isotope js -->
	<script src="assets/js/isotope.pkgd.min.js"></script>
	<!-- jquery meanmenu js -->
	<script src="assets/js/jquery.meanmenu.js"></script>
	<!-- jquery scrollup js -->
	<script src="assets/js/jquery.scrollUp.js"></script>
	<script src="assets/js/jquery.barfiller.js"></script>
	<script src="assets/js/typed.js"></script>
	<!-- jquery js -->
	<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	<script src="assets/js/vanilla-tilt.min.js"></script>
	<!-- partial -->

	<script src="assets/js/splide.min.js"></script>
	<!-- theme js -->
	<script src="assets/js/theme.js"></script>
</body>

</html>