<?php
	 	
	include("../config/connection.php");
	include("../includes/auth.php");

	if (isset($_SESSION['user_id'])) 
	{
		$user_id = $_SESSION['user_id'];
		$fetch = $con->query("SELECT * FROM `users` WHERE user_id = $user_id");

		foreach ($fetch as $data) 
		{
?>

<!DOCTYPE php>
<php lang="en">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/php;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta http-equiv="Content-Type" content="text/php; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
			<meta name="keywords" content="Genius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,SeaGenius,Ocean,Sea,Etc,Genius,Ocean,Sea">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car listing</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="../assets/front/images/favicon.png" type="image/x-icon">
	<!-- bootstrap -->
	<link rel="stylesheet" href="../assets/front/css/bootstrap.min.css">
	<!-- Plugin css -->
	<link rel="stylesheet" href="../assets/front/css/plugin.css">
	<!-- stylesheet -->
	<link rel="stylesheet" href="../assets/front/css/style.css">
	<!-- responsive -->
	<link rel="stylesheet" href="../assets/front/css/responsive.css">
	<!-- custom -->
	<link rel="stylesheet" href="../assets/front/css/custom.css">
	<!-- base color -->
	<link rel="stylesheet" href="../assets/front/css/styles8353.css?color=ff5328">
	<!-- <script async src = "https://www.googletagmanager.com/gtag/js?id=UA-137437974-1" ></script> -->
	<!-- <script>
	window.dataLayer = window.dataLayer || [];

	function gtag() {
	    dataLayer.push(arguments);
	}
	gtag('js', new Date());

	gtag('config', 'UA-137437974-1');
	</script> -->
</head>

<body>

			<!-- <div class="preloader" id="preloader" style="background: url(assets/front/images/loader.gif) no-repeat scroll center center #FFF;"></div> -->
	

	<!--Main-Menu Area Start-->
	<div class="mainmenu-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<nav class="navbar navbar-expand-lg navbar-light">
						<a class="navbar-brand" href="index.php">
							<img src="../assets/front/images/logo.png" alt="">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu" aria-controls="main_menu"
							aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse fixed-height" id="main_menu">
							<ul class="navbar-nav ml-auto">
								<li class="nav-item">
									<a class="nav-link  active " href="index.php">Home</a>
								</li>
								<li class="nav-item">
									<a class="nav-link " href="cars.php">Cars</a>
								</li>
																	<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown"
											aria-haspopup="true" aria-expanded="false">
											Pages
										</a>
										<div class="dropdown-menu">
																							<a class="dropdown-item " href="../about/pages.php">About Us</a>
																							<a class="dropdown-item " href="../privacy/pages.php">Privacy &amp; Policy</a>
																							<a class="dropdown-item " href="../termsu/pages.php">Terms &amp; Condition</a>
																							<a class="dropdown-item " href="../dynamic-page-OmtFT-7/pages.php">Dynamic Page</a>
																					</div>
									</li>
																								<li class="nav-item">
									<a class="nav-link " href="faq.php">FAQ</a>
								</li>
								
								<li class="nav-item">
									<a class="nav-link " href="blog.php">Blog</a>
								</li>

																	<li class="nav-item">
										<a class="nav-link " href="contact.php">Contact </a>
									</li>
															</ul>
							<a href="../register.php" class="mybtn1 ml-4">
								Logout
							</a>
						</div>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<!--Main-Menu Area Start-->

	    <!-- Hero Area Start -->
		<section class="hero-area">
            <img class="cars" src="../assets/front/images/heroarea-img.jpg" alt="">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            <div class="heading-area">
                                <h1 class="title">
                                    <h3>Welcome <?php echo $data['firstname']; ?></h3>
                                    CAR LISTING DIRECTORY
                                </h1>
                                <p class="sub-title">
                    	            <?php
                                        $listing = $con->query("SELECT * FROM `vehicle_list`");

                                        if ($listing) {
                                            $totalEntries = $listing->num_rows;
                                            echo "Over " . $totalEntries . " Classified Listings";
                                            $listing->free_result();
                                        } else {
                                            echo "Error executing the query: " . $con->error;
                                        }
                                    ?>
                                </p>
                            </div>
                            <form id="searchForm" action="index.php" method="get">
                                <ul class="select-list">
                                    <li>
                                        <div class="car-brand">
                                            <select class="js-example-basic-single" name="brand_id">
                                                <option value="" selected disabled>Brand</option>
                                                <?php
                        	                        $brands = $con->query("SELECT * FROM `brand_list` WHERE `status` = 1");
                                                    foreach ($brands as $brand) {
                                                        echo "<option value='" . $brand['brand_id'] . "'>" . $brand['brand_name'] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="car-condition">
                                            <select class="js-example-basic-single" name="type_id">
                                                <option value="" selected disabled>Type</option>
                                                <?php
                                                    $types = $con->query("SELECT * FROM `car_type_list` WHERE `status` = 1");
                                                    foreach ($types as $type) {
                                                        echo "<option value='" . $type['type_id'] . "'>" . $type['type_name'] . "</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="car-price">
                                            <select class="js-example-basic-single sel-price" name="price_range">
                                                <option value="" selected disabled>Pricing (USD)</option>
                                                <option value="10000-30000">10000.00 - 30000.00 </option>
                                                <option value="40000-60000">40000.00 - 60000.00 </option>
                                                <option value="70000-90000">70000.00 - 90000.00 </option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <button type="submit" class="mybtn1" style="width: 100%; outline: 0;">Search</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Area End -->

            <!-- Display search results -->
            <div class="container mt-5">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    $brandId = isset($_GET['brand_id']) ? $_GET['brand_id'] : '';
                    $typeId = isset($_GET['type_id']) ? $_GET['type_id'] : '';
                    $priceRange = isset($_GET['price_range']) ? $_GET['price_range'] : '';

                    $sql = "SELECT v.*, m.model_name FROM vehicle_list v
            		JOIN model_list m ON v.model_id = m.model_id
           			WHERE v.status = 1";

                    if (!empty($brandId)) {
                        $sql .= " AND m.brand_id = '$brandId'";
                    }

                    if (!empty($typeId)) {
                        $sql .= " AND m.type_id = '$typeId'";
                    }

                    if (!empty($priceRange)) {
                        list($minPrice, $maxPrice) = explode('-', $priceRange);
                        $sql .= " AND v.price BETWEEN '$minPrice' AND '$maxPrice'";
                    }

                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='card mb-3'>";
                            echo "<div class='card-body'>";
							echo "<h5 class='card-title'>Model Name: " . $row["model_name"] . "</h5>";
                            echo "<p class='card-title'>Plate Number: " . $row["plate_number"] . "</p>";
							echo "<h5 class='card-title'>Price: $" . $row["price"] . "</h5>";
                            echo "<p class='card-text'>Variant: " . $row["variant"] . "</p>";
                            // Add more fields as needed
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>No results found.</p>";
                    }
                }
                ?>
            </div>
			 <!-- Display search results -->

	<!-- Hero Area End -->


	<!-- Featured Cars Area Start -->
	<section class="featuredCars">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading">
						<h2 class="title">
							Featured Cars
						</h2>
						<p class="text">
						Immerse yourself in the allure of automotive excellence with our handpicked Featured Cars collection. Unveil the power and sophistication, top-tier performance, and unmatched luxury. Elevate your driving experience with our carefully selected showcase.
						</p>
					</div>
				</div>
			</div>
			
			<div class="row">
									<div class="col-lg-4 col-md-6">
							<a class="car-info-box" href="../details/15.php">
									<div class="img-area">
											<img class="light-zoom" src="../assets/front/images/cars/featured/6358fc21096e7.jpg" alt="">
									</div>
									<div class="content">
										<h4 class="title">
											2016 MCLAREN 650S
										</h4>
										<ul class="top-meta">
											<li>
												<i class="far fa-eye"></i> 1945 Views
											</li>
											<li>
												<i class="far fa-clock"></i> 4 years ago
											</li>
										</ul>
										<ul class="short-info">
											<li class="north-west" title="Model Year">
												<img src="../assets/front/images/calender-icon.png" alt="">
												<p>2016</p>
											</li>
											<li class="north-west" title="Mileage">
												<img src="../assets/front/images/road-icon.png" alt="">
												<p>500</p>
											</li>
											<li class="north-west" title="Top Speed (KMH)">
												<img src="../assets/front/images/transformar.png" alt="">
												<p>230.00</p>
											</li>
										</ul>
										<div class="footer-area">
											<div class="left-area">
																									<p class="price">
														$ 1,000
													</p>
												
											</div>
											<div class="right-area">
												<p class="condition">
													Used
												</p>
											</div>
										</div>
									</div>
							</a>
					</div>
									<div class="col-lg-4 col-md-6">
							<a class="car-info-box" href="../details/12.php">
									<div class="img-area">
											<img class="light-zoom" src="../assets/front/images/cars/featured/5d3fc9a42a81f.jpg" alt="">
									</div>
									<div class="content">
										<h4 class="title">
											2015 LEXUS RC 350
										</h4>
										<ul class="top-meta">
											<li>
												<i class="far fa-eye"></i> 1419 Views
											</li>
											<li>
												<i class="far fa-clock"></i> 4 years ago
											</li>
										</ul>
										<ul class="short-info">
											<li class="north-west" title="Model Year">
												<img src="../assets/front/images/calender-icon.png" alt="">
												<p>2015</p>
											</li>
											<li class="north-west" title="Mileage">
												<img src="../assets/front/images/road-icon.png" alt="">
												<p>200</p>
											</li>
											<li class="north-west" title="Top Speed (KMH)">
												<img src="../assets/front/images/transformar.png" alt="">
												<p>120.00</p>
											</li>
										</ul>
										<div class="footer-area">
											<div class="left-area">
																									<p class="price">
														 350 <del> 700</del>
													</p>
												
											</div>
											<div class="right-area">
												<p class="condition">
													New
												</p>
											</div>
										</div>
									</div>
							</a>
					</div>
									<div class="col-lg-4 col-md-6">
							<a class="car-info-box" href="../details/7.php">
									<div class="img-area">
											<img class="light-zoom" src="../assets/front/images/cars/featured/5d67959c9ca87.jpg" alt="">
									</div>
									<div class="content">
										<h4 class="title">
											2012 MERCEDES-BENZ M-CLASS
										</h4>
										<ul class="top-meta">
											<li>
												<i class="far fa-eye"></i> 503 Views
											</li>
											<li>
												<i class="far fa-clock"></i> 4 years ago
											</li>
										</ul>
										<ul class="short-info">
											<li class="north-west" title="Model Year">
												<img src="../assets/front/images/calender-icon.png" alt="">
												<p>2012</p>
											</li>
											<li class="north-west" title="Mileage">
												<img src="../assets/front/images/road-icon.png" alt="">
												<p>754490</p>
											</li>
											<li class="north-west" title="Top Speed (KMH)">
												<img src="../assets/front/images/transformar.png" alt="">
												<p>200.00</p>
											</li>
										</ul>
										<div class="footer-area">
											<div class="left-area">
																									<p class="price">
														$ 150
													</p>
												
											</div>
											<div class="right-area">
												<p class="condition">
													Recondtioned
												</p>
											</div>
										</div>
									</div>
							</a>
					</div>
							</div>
			<div class="row justify-content-center mt-3">
							</div>
		</div>
	</section>
	<!-- Featured Cars Area End -->

	<!-- Featured Cars Area Start -->
	<section class="latestCars">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading">
						<h2 class="title">
							Latest Cars
						</h2>
						<p class="text">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</p>
					</div>
				</div>
			</div>
			<div class="row">
									<div class="col-lg-4 col-md-6">
							<a class="car-info-box" href="../details/15.php">
									<div class="img-area">
											<img class="light-zoom" src="../assets/front/images/cars/featured/6358fc21096e7.jpg" alt="">
									</div>
									<div class="content">
										<h4 class="title">
											2016 MCLAREN 650S
										</h4>
										<ul class="top-meta">
											<li>
												<i class="far fa-eye"></i> 1945 Views
											</li>
											<li>
												<i class="far fa-clock"></i> 4 years ago
											</li>
										</ul>
										<ul class="short-info">
											<li class="north-west" title="Model Year">
												<img src="../assets/front/images/calender-icon.png" alt="">
												<p>2016</p>
											</li>
											<li class="north-west" title="Mileage">
												<img src="../assets/front/images/road-icon.png" alt="">
												<p>500</p>
											</li>
											<li class="north-west" title="Top Speed (KMH)">
												<img src="../assets/front/images/transformar.png" alt="">
												<p>230.00</p>
											</li>
										</ul>
										<div class="footer-area">
											<div class="left-area">
																									<p class="price">
														$ 1,000
													</p>
												
											</div>
											<div class="right-area">
												<p class="condition">
													Used
												</p>
											</div>
										</div>
									</div>
							</a>
					</div>
									<div class="col-lg-4 col-md-6">
							<a class="car-info-box" href="../details/14.php">
									<div class="img-area">
											<img class="light-zoom" src="../assets/front/images/cars/featured/5d415ceaa3375.jpg" alt="">
									</div>
									<div class="content">
										<h4 class="title">
											Lexus LFA &#039;2014
										</h4>
										<ul class="top-meta">
											<li>
												<i class="far fa-eye"></i> 681 Views
											</li>
											<li>
												<i class="far fa-clock"></i> 4 years ago
											</li>
										</ul>
										<ul class="short-info">
											<li class="north-west" title="Model Year">
												<img src="../assets/front/images/calender-icon.png" alt="">
												<p>2014</p>
											</li>
											<li class="north-west" title="Mileage">
												<img src="../assets/front/images/road-icon.png" alt="">
												<p>200</p>
											</li>
											<li class="north-west" title="Top Speed (KMH)">
												<img src="../assets/front/images/transformar.png" alt="">
												<p>140.00</p>
											</li>
										</ul>
										<div class="footer-area">
											<div class="left-area">
																									<p class="price">
														$ 750 <del>$ 770</del>
													</p>
												
											</div>
											<div class="right-area">
												<p class="condition">
													New
												</p>
											</div>
										</div>
									</div>
							</a>
					</div>
									<div class="col-lg-4 col-md-6">
							<a class="car-info-box" href="../details/12.php">
									<div class="img-area">
											<img class="light-zoom" src="../assets/front/images/cars/featured/5d3fc9a42a81f.jpg" alt="">
									</div>
									<div class="content">
										<h4 class="title">
											2015 LEXUS RC 350
										</h4>
										<ul class="top-meta">
											<li>
												<i class="far fa-eye"></i> 1419 Views
											</li>
											<li>
												<i class="far fa-clock"></i> 4 years ago
											</li>
										</ul>
										<ul class="short-info">
											<li class="north-west" title="Model Year">
												<img src="../assets/front/images/calender-icon.png" alt="">
												<p>2015</p>
											</li>
											<li class="north-west" title="Mileage">
												<img src="../assets/front/images/road-icon.png" alt="">
												<p>200</p>
											</li>
											<li class="north-west" title="Top Speed (KMH)">
												<img src="../assets/front/images/transformar.png" alt="">
												<p>120.00</p>
											</li>
										</ul>
										<div class="footer-area">
											<div class="left-area">
																									<p class="price">
														 350 <del> 700</del>
													</p>
												
											</div>
											<div class="right-area">
												<p class="condition">
													New
												</p>
											</div>
										</div>
									</div>
							</a>
					</div>
									<div class="col-lg-4 col-md-6">
							<a class="car-info-box" href="../details/11.php">
									<div class="img-area">
											<img class="light-zoom" src="../assets/front/images/cars/featured/5d3ecbd52f13e.jpg" alt="">
									</div>
									<div class="content">
										<h4 class="title">
											2011 NISSAN JUKE SL
										</h4>
										<ul class="top-meta">
											<li>
												<i class="far fa-eye"></i> 1003 Views
											</li>
											<li>
												<i class="far fa-clock"></i> 4 years ago
											</li>
										</ul>
										<ul class="short-info">
											<li class="north-west" title="Model Year">
												<img src="../assets/front/images/calender-icon.png" alt="">
												<p>2011</p>
											</li>
											<li class="north-west" title="Mileage">
												<img src="../assets/front/images/road-icon.png" alt="">
												<p>62662</p>
											</li>
											<li class="north-west" title="Top Speed (KMH)">
												<img src="../assets/front/images/transformar.png" alt="">
												<p>140.00</p>
											</li>
										</ul>
										<div class="footer-area">
											<div class="left-area">
																									<p class="price">
														$ 550 <del>$ 650</del>
													</p>
												
											</div>
											<div class="right-area">
												<p class="condition">
													Used
												</p>
											</div>
										</div>
									</div>
							</a>
					</div>
									<div class="col-lg-4 col-md-6">
							<a class="car-info-box" href="../details/10.php">
									<div class="img-area">
											<img class="light-zoom" src="../assets/front/images/cars/featured/5d3ec85216de2.jpg" alt="">
									</div>
									<div class="content">
										<h4 class="title">
											2015 LEXUS RC 350
										</h4>
										<ul class="top-meta">
											<li>
												<i class="far fa-eye"></i> 496 Views
											</li>
											<li>
												<i class="far fa-clock"></i> 4 years ago
											</li>
										</ul>
										<ul class="short-info">
											<li class="north-west" title="Model Year">
												<img src="../assets/front/images/calender-icon.png" alt="">
												<p>2015</p>
											</li>
											<li class="north-west" title="Mileage">
												<img src="../assets/front/images/road-icon.png" alt="">
												<p>35126</p>
											</li>
											<li class="north-west" title="Top Speed (KMH)">
												<img src="../assets/front/images/transformar.png" alt="">
												<p>130.00</p>
											</li>
										</ul>
										<div class="footer-area">
											<div class="left-area">
																									<p class="price">
														$ 600 <del>$ 800</del>
													</p>
												
											</div>
											<div class="right-area">
												<p class="condition">
													Recondtioned
												</p>
											</div>
										</div>
									</div>
							</a>
					</div>
									<div class="col-lg-4 col-md-6">
							<a class="car-info-box" href="../details/9.php">
									<div class="img-area">
											<img class="light-zoom" src="../assets/front/images/cars/featured/5d3ec6cd8d581.jpg" alt="">
									</div>
									<div class="content">
										<h4 class="title">
											2016 VOLKSWAGEN TOUAREG
										</h4>
										<ul class="top-meta">
											<li>
												<i class="far fa-eye"></i> 300 Views
											</li>
											<li>
												<i class="far fa-clock"></i> 4 years ago
											</li>
										</ul>
										<ul class="short-info">
											<li class="north-west" title="Model Year">
												<img src="../assets/front/images/calender-icon.png" alt="">
												<p>2016</p>
											</li>
											<li class="north-west" title="Mileage">
												<img src="../assets/front/images/road-icon.png" alt="">
												<p>28065</p>
											</li>
											<li class="north-west" title="Top Speed (KMH)">
												<img src="../assets/front/images/transformar.png" alt="">
												<p>180.00</p>
											</li>
										</ul>
										<div class="footer-area">
											<div class="left-area">
																									<p class="price">
														$ 450 <del>$ 600</del>
													</p>
												
											</div>
											<div class="right-area">
												<p class="condition">
													Used
												</p>
											</div>
										</div>
									</div>
							</a>
					</div>
							</div>
			<div class="row justify-content-center mt-3">
									<a href="cars.php" class="mybtn1">
						View More
					</a>
							</div>
		</div>
	</section>
	<!-- Featured Cars Area End -->

	<!-- Testimonial Area Start -->
	<section class="testimonial">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading">
						<h2 class="title">
							Customer Reviews
						</h2>
						<p class="text">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</p>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-10">
					<div class="testimonial-slider">
													<div class="single-testimonial">
									<div class="people">
											<div class="img">
													<img src="../assets/images/testimonials/1564382456people.png" alt="">
											</div>
											<h4 class="title">Mamun Khan</h4>
											<p class="designation">CEO of APPLE</p>
										</div>
									<div class="review-text">
										<p>
												"That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins"
										</p>
									</div>
							</div>
													<div class="single-testimonial">
									<div class="people">
											<div class="img">
													<img src="../assets/images/testimonials/1562488638attractive-beautiful-beauty-415829.jpg" alt="">
											</div>
											<h4 class="title">Joe Root</h4>
											<p class="designation">MANAGER, APPLE</p>
										</div>
									<div class="review-text">
										<p>
												"That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins"
										</p>
									</div>
							</div>
													<div class="single-testimonial">
									<div class="people">
											<div class="img">
													<img src="../assets/images/testimonials/1562489108adult-beach-casual-736716.jpg" alt="">
											</div>
											<h4 class="title">Jony Barristow</h4>
											<p class="designation">CTO, APPLE</p>
										</div>
									<div class="review-text">
										<p>
												"That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins"
										</p>
									</div>
							</div>
													<div class="single-testimonial">
									<div class="people">
											<div class="img">
													<img src="../assets/images/testimonials/1562488087adult-boy-casual-220453.jpg" alt="">
											</div>
											<h4 class="title">Json Roy</h4>
											<p class="designation">CEO, APPLE</p>
										</div>
									<div class="review-text">
										<p>
												"That conviction is where the process of change really begins—with the realization that just because a certain abuse has taken place in the past doesn’t mean that we have to tole. That conviction is where the process of change really begins"
										</p>
									</div>
							</div>
											</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Testimonial Area End -->

	<!-- Blog Area Start -->
	<section class="blog">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 col-md-10">
					<div class="section-heading">
						<h2 class="title">
							Latest Blog
						</h2>
						<p class="text">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="blog-slider">

													<div class="single-blog">
								<div class="img">
									<img src="../assets/images/blogs/1560403187blog.jpg" alt="">
								</div>
								<div class="content">
									<a href="../blog/25.php">
										<h4 class="title">
											Five secrets to become a model
										</h4>
									</a>
									<ul class="top-meta">
										<li>
											<a href="#">
													<i class="far fa-user"></i> Admin
											</a>
										</li>
										<li>
											<a href="#">
													<i class="far fa-calendar"></i> 2nd Jan, 2019
											</a>
										</li>
									</ul>
									<div class="text">
										<p>
												MIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light ...
										</p>
									</div>
									<a href="../blog/25.php" class="link">Read More<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
													<div class="single-blog">
								<div class="img">
									<img src="../assets/images/blogs/1560403442blur-businesswoman-caucasian-941555.jpg" alt="">
								</div>
								<div class="content">
									<a href="../blog/24.php">
										<h4 class="title">
											How to design effective arts?
										</h4>
									</a>
									<ul class="top-meta">
										<li>
											<a href="#">
													<i class="far fa-user"></i> Admin
											</a>
										</li>
										<li>
											<a href="#">
													<i class="far fa-calendar"></i> 2nd Jan, 2019
											</a>
										</li>
									</ul>
									<div class="text">
										<p>
												MIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light ...
										</p>
									</div>
									<a href="../blog/24.php" class="link">Read More<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
													<div class="single-blog">
								<div class="img">
									<img src="../assets/images/blogs/1560403521afro-attractive-beautiful-2253065.jpg" alt="">
								</div>
								<div class="content">
									<a href="../blog/23.php">
										<h4 class="title">
											How to design effective arts?
										</h4>
									</a>
									<ul class="top-meta">
										<li>
											<a href="#">
													<i class="far fa-user"></i> Admin
											</a>
										</li>
										<li>
											<a href="#">
													<i class="far fa-calendar"></i> 2nd Aug, 2018
											</a>
										</li>
									</ul>
									<div class="text">
										<p>
												MIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light ...
										</p>
									</div>
									<a href="../blog/23.php" class="link">Read More<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
													<div class="single-blog">
								<div class="img">
									<img src="../assets/images/blogs/1560403292adolescent-adult-attractive-1462637.jpg" alt="">
								</div>
								<div class="content">
									<a href="../blog/22.php">
										<h4 class="title">
											How to design effective arts?
										</h4>
									</a>
									<ul class="top-meta">
										<li>
											<a href="#">
													<i class="far fa-user"></i> Admin
											</a>
										</li>
										<li>
											<a href="#">
													<i class="far fa-calendar"></i> 2nd Jan, 2019
											</a>
										</li>
									</ul>
									<div class="text">
										<p>
												MIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light ...
										</p>
									</div>
									<a href="../blog/22.php" class="link">Read More<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
													<div class="single-blog">
								<div class="img">
									<img src="../assets/images/blogs/1560403590adult-blue-blue-sky-875862.jpg" alt="">
								</div>
								<div class="content">
									<a href="../blog/21.php">
										<h4 class="title">
											Read this blog if you are a beginner
										</h4>
									</a>
									<ul class="top-meta">
										<li>
											<a href="#">
													<i class="far fa-user"></i> Admin
											</a>
										</li>
										<li>
											<a href="#">
													<i class="far fa-calendar"></i> 2nd Jan, 2019
											</a>
										</li>
									</ul>
									<div class="text">
										<p>
												MIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light ...
										</p>
									</div>
									<a href="../blog/21.php" class="link">Read More<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
													<div class="single-blog">
								<div class="img">
									<img src="../assets/images/blogs/1560403627adult-attractive-beautiful-731070.jpg" alt="">
								</div>
								<div class="content">
									<a href="../blog/20.php">
										<h4 class="title">
											How to design effective arts?
										</h4>
									</a>
									<ul class="top-meta">
										<li>
											<a href="#">
													<i class="far fa-user"></i> Admin
											</a>
										</li>
										<li>
											<a href="#">
													<i class="far fa-calendar"></i> 2nd Aug, 2018
											</a>
										</li>
									</ul>
									<div class="text">
										<p>
												MIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light ...
										</p>
									</div>
									<a href="../blog/20.php" class="link">Read More<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
													<div class="single-blog">
								<div class="img">
									<img src="../assets/images/blogs/1560403334beautiful-cellphone-cute-761963.jpg" alt="">
								</div>
								<div class="content">
									<a href="../blog/18.php">
										<h4 class="title">
											How to design effective arts?
										</h4>
									</a>
									<ul class="top-meta">
										<li>
											<a href="#">
													<i class="far fa-user"></i> Admin
											</a>
										</li>
										<li>
											<a href="#">
													<i class="far fa-calendar"></i> 2nd Jan, 2019
											</a>
										</li>
									</ul>
									<div class="text">
										<p>
												MIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light ...
										</p>
									</div>
									<a href="../blog/18.php" class="link">Read More<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
													<div class="single-blog">
								<div class="img">
									<img src="../assets/images/blogs/1560403662beautiful-brown-hair-casual-1989252.jpg" alt="">
								</div>
								<div class="content">
									<a href="../blog/17.php">
										<h4 class="title">
											Modeling profession or passion
										</h4>
									</a>
									<ul class="top-meta">
										<li>
											<a href="#">
													<i class="far fa-user"></i> Admin
											</a>
										</li>
										<li>
											<a href="#">
													<i class="far fa-calendar"></i> 2nd Jan, 2019
											</a>
										</li>
									</ul>
									<div class="text">
										<p>
												MIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light ...
										</p>
									</div>
									<a href="../blog/17.php" class="link">Read More<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
													<div class="single-blog">
								<div class="img">
									<img src="../assets/images/blogs/1560403701adult-brunette-editorial-2224735.jpg" alt="">
								</div>
								<div class="content">
									<a href="../blog/16.php">
										<h4 class="title">
											How to design effective arts?
										</h4>
									</a>
									<ul class="top-meta">
										<li>
											<a href="#">
													<i class="far fa-user"></i> Admin
											</a>
										</li>
										<li>
											<a href="#">
													<i class="far fa-calendar"></i> 2nd Aug, 2018
											</a>
										</li>
									</ul>
									<div class="text">
										<p>
												MIAMI — For decades, South Florida schoolchildren and adults fascinated by far-off galaxies, earthly ecosystems, the proper ties of light ...
										</p>
									</div>
									<a href="../blog/16.php" class="link">Read More<i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Blog Area End -->

	<!-- Footer Area Start -->
	<footer class="footer" id="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget about-widget">
						<div class="footer-logo">
							<a href="index.php">
								<img src="../assets/front/images/footer_logo.png" alt="">
							</a>
						</div>
						<div class="text">
							<p>
							Wheel Deal is your go-to platform for hassle-free car transactions. Browse a diverse range of vehicles or effortlessly list your own for sale. With a user-friendly interface and a commitment to transparency, Wheel Deal transforms the car buying and selling experience into a seamless journey for automotive enthusiasts.
							</p>
						</div>

					</div>
				</div>
				<div class="col-md-6 col-lg-4">
					<div class="footer-widget address-widget">
						<h4 class="title">
							Address
						</h4>
						<ul class="about-info">
							<li>
								<p>
										<i class="fas fa-globe"></i>
									250 Los Angles, California, USA
								</p>
							</li>
							<li>
								<p>
										<i class="fas fa-phone"></i>
										(000) 123-4567
								</p>
							</li>
							<li>
								<p>
										<i class="far fa-envelope"></i>
										your@example.com
								</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-lg-4">
						<div class="footer-widget  footer-newsletter-widget">
							<h4 class="title">
								Newsletter
							</h4>
							<div class="alert alert-success validation alert-dismissible fade show" style="display: none;" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            <p class="text-left"></p>
      </div>
      <div class="alert alert-danger validation" style="display: none;">
      <button type="button" class="close alert-close"><span>×</span></button>
            <ul class="text-left">
            </ul>
      </div>
							<div class="gocover" style="background: url(assets/front/images/loader.gif) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
							<div class="newsletter-form-area">
								<form id="geniusform" action="" href="index.php" method="post">
									<input type="hidden" name="_token" value="n302Yx2NxglF4pv5Ht2MzB5s9GizoBDTQo9luSjW">
									<input type="email" name="email" placeholder="Your email address..." required>
									<button type="submit">
										<i class="far fa-paper-plane"></i>
									</button>
								</form>
							</div>
							<div class="social-links">
								<h4 class="title">
										FOLLOW US :
								</h4>
								<div class="fotter-social-links">
									<ul>
											                  	                  	                  <li>
	                     <a href="https://www.instagram.com/" target="_blank">
	                     <i class="fab fa-instagram"></i>
	                     </a>
	                  </li>
	                  	                  	                  	                  									</ul>
								</div>
							</div>

						</div>
				</div>
			</div>
		</div>
		<div class="copy-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
							<div class="content">
								<div class="content">
									<p><font color="#ffffff">Copyright © 2025. All Rights Reserved By </font><a SAT title="" target=""><font color="#ff6699">SAT</font></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- Footer Area End -->

	<!-- Back to Top Start -->
	<div class="bottomtotop">
		<i class="fas fa-chevron-right"></i>
	</div>
	<!-- Back to Top End -->

	<!-- jquery -->
	<script src="../assets/front/js/jquery.js"></script>
	<!-- bootstrap -->
	<script src="../assets/front/js/bootstrap.min.js"></script>
	<!-- popper -->
	<script src="../assets/front/js/popper.min.js"></script>
	<!-- plugin js-->
	<script src="../assets/front/js/plugin.js"></script>
	<script src="../assets/front/js/toltip.js"></script>
	<!-- main -->
	<script src="../assets/front/js/main.js"></script>
	<!-- <script>
		var gs = {"id":"1","title":"Car listing","footer":"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae","copyright":"<font color=\"#ffffff\">Copyright \u00a9 2019. All Rights Reserved By <\/font><a href=\"https:\/\/geniusocean.com\/\" title=\"\" target=\"\"><font color=\"#ff6699\">GeniusOcean.com<\/font><\/a>","footer_logo":"F:\\xampp\\tmp\\phpBEF1.tmp","colors":"#ff5328","loader":"F:\\xampp1\\tmp\\php1336.tmp","is_aloader":"1","is_talkto":"0","talkto":"<script type=\"text\/javascript\">\r\nvar Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();\r\n(function(){\r\nvar s1=document.createElement(\"script\"),s0=document.getElementsByTagName(\"script\")[0];\r\ns1.async=true;\r\ns1.src='https:\/\/embed.tawk.to\/5bc2019c61d0b77092512d03\/default';\r\ns1.charset='UTF-8';\r\ns1.setAttribute('crossorigin','*');\r\ns0.parentNode.insertBefore(s1,s0);\r\n})();\r\n<\/script>","is_language":"1","is_loader":"1","map_key":"AIzaSyB1GpE4qeoJ__70UZxvX9CTMUTZRZNHcu8","is_disqus":"0","disqus":"<div id=\"disqus_thread\"><\/div>\r\n<script>\r\n\r\n\/**\r\n*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.\r\n*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https:\/\/disqus.com\/admin\/universalcode\/#configuration-variables*\/\r\n\/*\r\nvar disqus_config = function () {\r\nthis.page.url = PAGE_URL;  \/\/ Replace PAGE_URL with your page's canonical URL variable\r\nthis.page.identifier = PAGE_IDENTIFIER; \/\/ Replace PAGE_IDENTIFIER with your page's unique identifier variable\r\n};\r\n*\/\r\n(function() { \/\/ DON'T EDIT BELOW THIS LINE\r\nvar d = document, s = d.createElement('script');\r\ns.src = 'https:\/\/model-4.disqus.com\/embed.js';\r\ns.setAttribute('data-timestamp', +new Date());\r\n(d.head || d.body).appendChild(s);\r\n})();\r\n<\/script>\r\n<noscript>Please enable JavaScript to view the <a href=\"https:\/\/disqus.com\/?ref_noscript\">comments powered by Disqus.<\/a><\/noscript>","is_faq":"1","smtp_host":"in-v3.mailjet.com","smtp_port":"587","smtp_user":"0e05029e2dc70da691aa2223aa53c5be","smtp_pass":"5df1b6242e86bce602c3fd9adc178460","from_email":"admin@geniusocean.com","from_name":"GeniusOcean","is_smtp":"0","is_comment":"1","is_currency":"1","favicon":null,"ss":"sk_test_QQcg3vGsKRPlW6T3dXcNJsor","pb":"Adjr_NvX4lUV6PQCi15BgedrVJMHnpnVc-H51LhimBj5nhS_iKHJMXMN68fQx9UItjuqyUT2ubv7mkeT","facebook":"https:\/\/www.facebook.com\/","instagram":"https:\/\/www.instagram.com\/","gplus":"https:\/\/www.google.com\/","twitter":"https:\/\/twitter.com\/","linkedin":"https:\/\/bd.linkedin.com\/","dribble":"https:\/\/dribbble.com\/","f_status":"0","i_status":"1","g_status":"0","t_status":"0","l_status":"0","d_status":"0","footer_address":"250 Los Angles, California, USA","footer_phone":"(000) 123-4567","footer_email":"your@example.com"};
	</script> -->
	<!-- custom -->
	<!-- <script src="assets/front/js/custom.js"></script>

	<script>
	$(".sel-price").on('change', function() {
		let url = 'https://product.geniusocean.com/carspace/prices/' + $(this).val();
		// console.log(url);
		$.get(
			url,
			function(data) {
				console.log(data);
				$("input[name='minprice']").val(data.minimum);
				$("input[name='maxprice']").val(data.maximum);
			}
		)
	});
</script> -->
</body>

</php>
<?php
	}
}
?>