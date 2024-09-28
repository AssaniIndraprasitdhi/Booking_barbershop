<!DOCTYPE html>
<html>

<head>
	<title>Barbershop</title>
</head>
<!-- bootstrap Style CSS File -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Custom Style CSS File -->
<link rel="stylesheet" type="text/css" href="css/custom-style.css">
<link rel="stylesheet" type="text/css" href="css/loaders.css" />
<!-- Font-Awesome Style CSS File -->
<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">

<body>

	<!-- Page loading animation -->
	<div class="loader loader-bg">
		<div class="loader-inner ball-pulse">
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>

	<!-- Top navigation -->
	<nav class="navbar navbar-expand-md fixed-top top-nav">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.html"><strong>Barbershop</strong></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"><img src="img/icons/menu.png"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav m-auto text-sm-center text-md-center">
					<li class="nav-item">
						<a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#services">Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#price">Prices</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="views/signin.php">Booking Detail</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="views/signin.php">Profile</a>
					</li>
				</ul>
				<a class="btn btn-primary text-white mr-3" href="views/signup.php">Sign up</a>
				<a class="btn btn-primary text-white mr-3" href="views/signin.php">Sign in</a>
			</div>

		</div>
	</nav>

	<!-- Intro Three -->
	<section id="home" class="intro intro-bg bg-overlay parallax">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12 caption-two-panel ml-auto pt-5">
					<div class="intro-caption mt-5">
						<h1 class="text-white mb-2">Welcome to Barbershop</h1>
						<p class="text-white mb-4"> Men's haircut by a professional barber More than 20 years of experience.
						 You will experience a very exclusive haircut at our shop.
						</p>
						<a class="btn btn-primary text-white mr-3" href="./views/signin.php">Booking now</a>
					</div>
				</div>
			</div>
	</section>

	<!-- Info block 1 -->
	<section id="services" class="info-section text-white bg-right bg-dark">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="head-box">
						<h2 class="font-abril ">Services We offered!</h2>
					</div>
					<div class="three-panel-block mt-5">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="service-block mb-5">
									<i class="icon-box mb-3 float-left w-100"><img src="img/icons/scissors.png"
											class="img-fluid"></i>
									<h3 class="text-primary">Scissor Cut</h3>
									<p>Never in all their history have men been able truly to conceive of the world as
										one a single sphere</p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="service-block mb-5">
									<i class="icon-box mb-3 float-left w-100"><img src="img/icons/razor-1.png"
											class="img-fluid"></i>
									<h3 class="text-primary">Shave</h3>
									<p>It's a beard trimming. Both clean shave or trim</p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="service-block mb-5">
									<i class="icon-box mb-3 float-left w-100"><img src="img/icons/brush.png"
											class="img-fluid"></i>
									<h3 class="text-primary">Hair Color</h3>
									<p>Various color treatments, including covering white hair or fashion coloring</p>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="service-block">
									<i class="icon-box mb-3 float-left w-100"><img src="img/icons/hair-clip.png"
											class="img-fluid"></i>
									<h3 class="text-primary">Clipper Cut</h3>
									<p>Never in all their history have men been able truly to conceive of the world as
										one a single sphere</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Info block 2 -->
	<section id="price" class="info-section sec-bg-03 bg-overlay">
		<div class="container text-white">
			<div class="head-box text-center mb-5">
				<h2 class="font-abril">Our Jaw Drop Prices</h2>
			</div>
			<div class="three-panel-block my-4">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 pl-md-5 mb-4">
						<div class="service-block-bg text-center p-3">
							<div class="price-count font-abril">Start at 100<span>฿</span></div>
							<h3>Haircut</h3>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 pr-md-5 mb-4">
						<div class="service-block-bg text-center p-3">
							<div class="price-count font-abril">1200<span>฿</span></div>
							<h3>Hair Color</h3>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 pl-md-5 mb-4">
						<div class="service-block-bg text-center p-3">
							<div class="price-count font-abril"><span>$</span>20</div>
							<h3>Shave</h3>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 pr-md-5">
						<div class="service-block-bg text-center p-3">
							<div class="price-count font-abril">Free<span></span></div>
							<h3>Haircut(Monk)</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Javascript Files  -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="js/core.js"></script>
</body>

</html>