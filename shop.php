<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="it-rating" content="it-rat-cd303c3f80473535b3c667d0d67a7a11">
    <meta name="cmsmagazine" content="3f86e43372e678604d35804a67860df7">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
    <title>Allen Salon - Shop</title>
    <meta name='description' content="" />
    <meta name="keywords" content="" />
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/13.css" />
</head>

<body class="loaded">

    <!-- BEGIN BODY -->
    <div class="main-wrapper">

        <!-- BEGIN CONTENT -->

        <main class="content">
            <!-- BEGIN DETAIL MAIN BLOCK -->
            <div class="detail-block detail-block_margin">
                <!-- Detail main block content goes here -->
            </div>
            <!-- DETAIL MAIN BLOCK EOF   -->

            <!-- PRODUK BOX -->
            <div class="produk-box">
                <?php
                // Database Configuration
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $database = 'dballen';

                // Create a database connection
                $conn = new mysqli($host, $user, $password, $database);
                if ($conn->connect_error) {
                    die("Connection to the database failed: " . $conn->connect_error);
                }

                // Query products
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="product-item">';
                        echo '<img src="gambarproduk/' . $row['gambarproduk'] . '" alt="Product Image">';
                        echo '<h3>' . $row['namaproduk'] . '</h3>';
                        echo '<p>Harga: ' . $row['hargaproduk'] . '</p>';
                        echo '<p>' . $row['deskripsiproduk'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo 'No products found.';
                }

                // Close the database connection
                $conn->close();
                ?>
            </div>
            <!-- DETAIL MAIN BLOCK EOF   -->

            <!-- PRODUK BOX -->
            <div class="produk-box">
            
            </div>
            <!-- PRODUK BOX EOF -->

        </main>

        <!-- CONTENT EOF   -->
		<!-- BEGIN HEADER -->

		<header class="header">
			<div class="header-top">
				<span></span>
				<i class="header-top-close js-header-top-close icon-close"></i>
			</div>
			<div class="header-content">
				<div class="header-logo">
					<img src="img/LOGO (7).png" alt="">
				</div>
				<div class="header-box">
					<ul class="header-nav">
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li></li>						
						<li><a href="index.html">Home</a></li>
						<li><a href="shop.php" class="active">Categories</a></li>
						<li><a href="contacts.html">contact</a></li>
					</ul>
					<ul class="header-options">
						<li><a href="login.php"><i class="icon-user"></i></a></li>
					</ul>
				</div>

				<div class="btn-menu js-btn-menu"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div>
			</div>
		</header>

		<!-- HEADER EOF   -->

	        <!-- BEGIN FOOTER -->

			<footer class="footer">
				<div class="wrapper">
					<div class="footer-top">
						<div class="footer-top__social">
							<span>Find us here:</span>
							<ul>
							
								<li><a href="https://instagram.com/alensalon_cimahi?igshid=MmIzYWVlNDQ5Yg=="><i class="icon-insta"></i></a></li>
								
							</ul>
						</div>
						<div class="footer-top__logo">
							<img data-src="img/LOGO (7).png" src="img/LOGO (7).png"
								class="js-img" alt="">
						</div>
						<div class="footer-top__payments">
							<span>Payment methods:</span>
							<ul>
								<li><img data-src="img/payment1.png" src="data:image/gif;base64,R0lGODlhAQABAAAAACw="
										class="js-img" alt=""></li>
								<li><img data-src="img/payment2.png" src="data:image/gif;base64,R0lGODlhAQABAAAAACw="
										class="js-img" alt=""></li>
								<li><img data-src="img/payment3.png" src="data:image/gif;base64,R0lGODlhAQABAAAAACw="
										class="js-img" alt=""></li>
							</ul>
						</div>
					</div>
					<div class="footer-nav">
						<div class="footer-nav__col">
							<span class="footer-nav__col-title">Page</span>
							<ul>
								<li><a href="index.html">Home</a></li>
								<li><a href="shop.php">Product</a></li>
								<li><a href="contacts.html">Contacts</a></li>
							</ul>
						</div>
						<div class="footer-nav__col">
							<span class="footer-nav__col-title">Product</span>
							<ul>
								<li><a href="index.html">Shampoo</a></li>
								<li><a href="index.html">Conditioner</a></li>
								<li><a href="index.html">Vitamin</a></li>
								<li><a href="index.html">Hair Mask</a></li>
							</ul>
						</div>
					<div class="footer-bottom">
						<p class="footer-bottom__text">© 2023 Allen. All Rights Reserved</p>
					</div>
				</div>
			</footer>
	
			<!-- FOOTER EOF   -->
    </div>

    <!-- END BODY -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/lazyload.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.maskedinput.js"></script>
    <script src="js/ion.rangeSlider.min.js"></script>
    <script src="js/jquery.formstyler.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>