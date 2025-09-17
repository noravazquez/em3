<?php
require_once "../config/database.php";
require_once "../lib/projects_public.php";

$projectsHome = getProjectsHome($db);
?>
<!DOCTYPE HTML>
<html lang="en-US">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Em3 - Construcciones</title>
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
	<!-- LISTOOOOOOO -->
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
	<!-- Start solutek hero Area -->
	<!--==================================================-->
	<div class="hero-area d-flex align-items-center">
		<div class="container">
			<div class="row hero align-items-center">
				<div class="col-lg-6">
					<div class="hero-contant">
						<h5>Em3 - Construcciones</h5>
						<h1>EMPRESA ORGULLOSAMENTE MEXICANA</h1>
						<h1>¡Todo para tu proyecto!</h1>
						<p>Desarrollar y perfeccionar al grado máximo la creatividad en la arquitectura y construcción
						</p>
						<div class="solutek-btn">
							<a href="about-us.html">Explora más
								<div class="solutek-hover-btn hover-bx"></div>
								<div class="solutek-hover-btn hover-bx2"></div>
								<div class="solutek-hover-btn hover-bx3"></div>
								<div class="solutek-hover-btn hover-bx4"></div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="hero-thumb">
						<img src="./assets/images/home/hero_thumb.png" alt="hero-thumb">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- end solutek hero Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start solutek about Area -->
	<!--==================================================-->
	<div class="feature-area">
		<div class="container">
			<div class="row about align-items-center">
				<div class="feature-box">
					<div class="feature-sinble-single-box">
						<div class="feature-icon">
							<img src="assets/images/home/services/diseno_arquitectonico.svg"
								alt="Diseño arquitectónico y construcción">
						</div>
						<div class="feature-content">
							<h3 class="feature-title">Diseño arquitectónico y construcción</h3>
						</div>
					</div>
					<div class="feature-sinble-single-box">
						<div class="feature-icon">
							<img src="assets/images/home/services/obra_civil.svg"
								alt="Obra civil vertical y horizontal">
						</div>
						<div class="feature-content">
							<h3 class="feature-title">Obra civil vertical y horizontal</h3>
						</div>
					</div>
					<div class="feature-sinble-single-box">
						<div class="feature-icon">
							<img src="assets/images/home/services/contruccion_mante_industrial.svg"
								alt="Construcción y mantenimiento industrial">
						</div>
						<div class="feature-content">
							<h3 class="feature-title">Construcción y mantenimiento industrial</h3>
						</div>
					</div>
					<div class="feature-sinble-single-box">
						<div class="feature-icon">
							<img src="assets/images/home/services/estructura_metal.svg" alt="Estructura metálica">
						</div>
						<div class="feature-content">
							<h3 class="feature-title">Estructura metálica</h3>
						</div>
					</div>
					<div class="feature-sinble-single-box">
						<div class="feature-icon">
							<img src="assets/images/home/services/albanileria.svg" alt="Albañilerías">
						</div>
						<div class="feature-content">
							<h3 class="feature-title">Albañilerías</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- end solutek about Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- start solutek about Area -->
	<!--==================================================-->
	<div class="about-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-lg-6">
					<div class="about-thumb">
						<img src="assets/images/home/about-thumb.jpg" alt="about-thumb">
						<div class="about-shape">
							<img src="assets/images/home/about1.png" alt="about1">
						</div>
						<h4 class="about-title">¡Transformamos espacios!</h4>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="section-title text-left">
						<h5 class="section-sub-title mt-3">Em3 - Construcciones</h5>
						<h1 class="section-main-title">¡Haz de tu proyecto</h1>
						<h1 class="section-main-title"><span>una realidad</span> con nosotros!</h1>
						<p class="section-title-descr">Desarrolla ese espacio que siempre habías deseado y trabaja de la
							mano de los expertos.</p>
					</div>
					<div class="about-box d-flex align-items-center">
						<div class="about-icon">
							<img src="assets/images/home/project-management.png" alt="about4">
						</div>
						<div class="about-tiltle">
							<h3>¡Todo para tu proyecto!</h3>
						</div>
					</div>
					<div class="about-text">
						<p>Nuestro excelente trabajo nos respalda como tu mejor opción: Diseño arquitectónico, Fachadas,
							Ampliaciones, Remodelaciones, Terrazas. ¡Y MÁS!</p>
					</div>
					<div class="solutek-btn">
						<a href="about-us.html">EXPLORA MÁS
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
	<!--==================================================-->
	<!-- end solutek about Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- start solutek service Area -->
	<!--==================================================-->
	<div class="sservice-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title text-center">
						<h5 class="section-sub-title">Em3 - Servicios</h5>
						<h1 class="section-main-title">Más servicios</h1>
						<h1 class="section-main-title">que <span>ofrecemos.</span></h1>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 mb-3">
					<div class="service-single-box terracerias">
						<div class="service-icon">
							<img src="assets/images/home/services/Terracerias.svg" alt="Terracerías">
						</div>
						<div class="service-content">
							<h3 class="service-title">Terracerías</h3>
							<div class="service-btn">
								<a href="service.html"><i class="fas fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 mb-3">
					<div class="service-single-box acabados">
						<div class="service-icon">
							<img src="assets/images/home/services/estructura_metalica.svg"
								alt="Acabados y trabajos específicos de obra">
						</div>
						<div class="service-content">
							<h3 class="service-title">Acabados y trabajos específicos de obra</h3>
							<div class="service-btn">
								<a href="service.html"><i class="fas fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 mb-3">
					<div class="service-single-box rehabilitacion">
						<div class="service-icon">
							<img src="assets/images/home/services/contruccion_manteni_industrial.svg"
								alt="Rehabilitación y adecuación de espacios">
						</div>
						<div class="service-content">
							<h3 class="service-title">Rehabilitación y adecuación de espacios</h3>
							<div class="service-btn">
								<a href="service.html"><i class="fas fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-6 mb-3">
					<div class="service-single-box asesoria">
						<div class="service-icon">
							<img src="assets/images/home/services/diseno_arquitectonico02.svg"
								alt="Asesoría y gestión técnica">
						</div>
						<div class="service-content">
							<h3 class="service-title">Asesoría y gestión técnica</h3>
							<div class="service-btn">
								<a href="service.html"><i class="fas fa-plus"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="service-shape bounce-animate3">
				<img src="assets/images/service5.png" alt="service5">
			</div>
			<div class="service-shape2">
				<img src="assets/images/service7.png" alt="service5">
			</div>
			<div class="service-shape3 bounce-animate4">
				<img src="assets/images/service8.png" alt="service5">
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- end solutek service Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- start solutek project Area -->
	<!--==================================================-->
	<div class="project-area">
		<div class="container-fluid">
			<div class="row project align-items-center">
				<div class="col-lg-6">
					<div class="section-title text-left">
						<h5 class="section-sub-title">Em3 - Proyectos</h5>
						<h1 class="section-main-title">Conoce nuestros últimos <span>proyectos.</span></h1>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="project-right">
						<div class="solutek-btn">
							<a href="project.html">VER PROYECTOS
								<div class="solutek-hover-btn hover-bx"></div>
								<div class="solutek-hover-btn hover-bx2"></div>
								<div class="solutek-hover-btn hover-bx3"></div>
								<div class="solutek-hover-btn hover-bx4"></div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row carousel">
				<div class="project_list owl-carousel">
					<?php foreach ($projectsHome as $p): ?>
						<?php
						$images = getImagesByProject($db, $p['id_proyecto']);
						$thumbnail = !empty($images) ? "proyectos/" . $p['id_proyecto'] . "/" . $images[0]['nombre_archivo'] : "no-imagen.jpg";
						?>
						<div class="col-lg-12 col-md-12">
							<div class="project-single-box">
								<div class="project-thumb">
									<img src="admin/project_gallery/uploads/<?= htmlspecialchars($thumbnail); ?>" alt="<?= htmlspecialchars($p['nombre']); ?>">
								</div>
								<div class="project-content">
									<h3 class="project-title"><a><?= htmlspecialchars($p['nombre']); ?></a></h3>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- end solutek project Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- start solutek-brand Area -->
	<!--==================================================-->
	<div class="brand-area">
		<div class="container">
			<div class="row">
				<div class="brand_list owl-carousel">
					<div class="col-lg-12">
						<div class="brand-box">
							<div class="brand-thumb">
								<img src="assets/images/home/brands/axioma.svg" alt="axioma">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="brand-box">
							<div class="brand-thumb">
								<img src="assets/images/home/brands/beck.svg" alt="beck">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="brand-box">
							<div class="brand-thumb">
								<img src="assets/images/home/brands/campanario.svg" alt="campanario">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="brand-box">
							<div class="brand-thumb">
								<img src="assets/images/home/brands/dm_desarrollos.svg" alt="dm desarrollos">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="brand-box">
							<div class="brand-thumb">
								<img src="assets/images/home/brands/fiesta_INN.svg" alt="fiesta inn">
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="brand-box">
							<div class="brand-thumb">
								<img src="assets/images/home/brands/naya.svg" alt="naya">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--==================================================-->
	<!-- end solutek-brand Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- start solutek-faq Area -->
	<!--==================================================-->
	<div class="faq-area">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 col-md-12">
					<div class="section-title text-left">
						<h5 class="section-sub-title">Em3 - Construcciones</h5>
						<h1 class="section-main-title">Cuidamos cada detalle</h1>
						<h1 class="section-main-title">de tu <span>proyecto.</span></h1>
					</div>
					<div class="faq-thumb">
						<img src="assets/images/home/qa_home.jpg" alt="QA">
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="tab_container">
						<div class="feq-content">
							<h3 class="faq-title">Preguntas <span>frecuentes.</span></h3>
							<p class="faq-description">Desarrolla ese espacio que siempre habías deseado y trabaja de la
								mano de los expertos</p>
						</div>
						<div id="tab1" class="tab_content">
							<ul class="accordion">
								<li>
									<a class=""><span>¿Si ya cuento con planos elaborados por un arquitecto, puedo
											acudir con ustedes para la construcción?</span></a>
									<p style="display: none;">Si, además podemos orientarte o guiarte para que tengas
										mejores y mas transparentes opciones para tu proyecto.</p>
								</li>
								<li>
									<a><span>¿Trabajan con diferentes tipos de presupuestos?</span></a>
									<p>Del tipo de servicio que manejamos si, aunque también podemos orientarte o
										recomendarte sobre cualquier tipo de presupuesto relacionado a la construcción
										que no este dentro de nuestro portafolio.</p>
								</li>
								<li>
									<a><span>¿En qué partes de la República Mexicana ofrecen sus servicios?</span></a>
									<p>Prácticamente a lo largo y ancho de toda la República Mexicana.</p>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="faq-shape">
				<img src="assets/images/home/faq2.png" alt="faq2">
			</div>
			<div class="faq-shape2">
				<img src="assets/images/home/faq3.png" alt="faq2">
			</div>
		</div>
	</div>
	<!--==================================================-->
	<!-- end solutek-faq Area -->
	<!--==================================================-->

	<!--==================================================-->
	<!-- Start solutek contact Area -->
	<!--==================================================-->
<!-- 

	<div class="contact-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-7">
					<div class="section-title text-left">
						<h5 class="section-sub-title">CONTÁCTANOS</h5>
						<h1 class="section-main-title">Solicita una asesoría</h1>
						<h1 class="section-main-title">y cotiza con nosotros.</h1>
					</div>
					<div class="contact_from_box">
						<form action="https://formspree.io/f/myyleorq" method="POST" id="dreamit-form">
							<div class="row">
								<div class="col-lg-6">
									<div class="form_box">
										<input type="text" name="name" placeholder="Nombre completo *">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form_box">
										<input type="email" name="email" placeholder="Correo electrónico *">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form_box">
										<input type="text" name="subject" placeholder="Asunto *">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form_box">
										<input type="text" name="phone" placeholder="Número de teléfono *">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form_box">
										<textarea name="message" id="message" cols="30" rows="10"
											placeholder="Mensaje"></textarea>
									</div>
									<div class="quote_button">
										<button class="btn" type="submit">ENVIAR <i
												class="bi bi-arrow-right"></i></button>
									</div>
								</div>
							</div>
						</form>
						<div id="status" class="error"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-5">
					&nbsp;
				</div>
			</div>
		</div>
	</div>


 -->
	<!--==================================================-->
	<!-- end solutek contact Area -->
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
							<h3>Tu visión, nuestro diseño.</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="address-box2">
						<div class="address-icon">
							<img src="assets/images/address2.png" alt="address1">
						</div>
						<div class="solutek-btn">
							<a href="contact.html">442 224 22 94
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
							<a href="index.php"><img src="assets/images/logoem3.svg" alt="footer-logo"></a>
						</div>
						<p class="footer-widget-text">Nos certificamos para garantizar calidad en nuestros productos y
							servicios.</p>
						<div class="footer-social">
							<div class="footer-widget-social">
								<a href="https://www.facebook.com/em3construcciones"><i class="fab fa-facebook-f"></i></a>
								<a href="https://www.linkedin.com/company/em3-construcciones/"><i class="fab fa-linkedin-in"></i></a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="footer-widget left">
						<div class="widget-title">
							<h2>Accesos directos</h2>
						</div>
						<ul>
							<li><a href="about-us.html">Sobre nosotros</a></li>
							<li><a href="contact.html">Contáctanos</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="footer-widget left">
						<div class="widget-title">
							<h2>Que ofrecemos</h2>
						</div>
						<ul>
							<li><a href="service.html">Nuestros servicios</a></li>
							<li><a href="project.html">Portafolio</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row copyright">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<div class="-copyright-text">
						<p>© Copyright 2024 By NV</p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6">
					&nbsp;
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
	<!-- theme js -->
	<script src="assets/js/theme.js"></script>
</body>
</html>