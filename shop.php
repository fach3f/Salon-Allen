<?php
// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'dballen';

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Cek apakah data telah diterima melalui formulir atau permintaan POST/GET
if (isset($_POST['nama_produk']) && isset($_POST['harga_produk']) && isset($_POST['deskripsi_produk']) && isset($_FILES['gambar_produk'])) {
    // Mendapatkan data yang dikirim dari form upload
    $namaProduk = $_POST['nama_produk'];
    $hargaProduk = $_POST['harga_produk'];
    $deskripsiProduk = $_POST['deskripsi_produk'];
    $gambarProduk = $_FILES['gambar_produk'];

    // Mendapatkan informasi file gambar
    $namaFile = isset($gambarProduk['name']) ? $gambarProduk['name'] : '';
    $ukuranFile = isset($gambarProduk['size']) ? $gambarProduk['size'] : 0;
    $tmpFile = isset($gambarProduk['tmp_name']) ? $gambarProduk['tmp_name'] : '';
    $error = isset($gambarProduk['error']) ? $gambarProduk['error'] : 0;

    // Memindahkan file gambar ke folder tujuan
    $folderTujuan = 'uploads/'; // Ganti dengan folder tujuan di server Anda
    $namaFileTujuan = $folderTujuan . $namaFile;

    if ($error === 0) {
        if (move_uploaded_file($tmpFile, $namaFileTujuan)) {
            // File berhasil diupload, simpan informasi produk ke database
            $namaFileTujuan = $conn->real_escape_string($namaFileTujuan); // Menghindari serangan SQL injection

            $sql = "INSERT INTO products (namaproduk, hargaproduk, deskripsiproduk, gambarproduk) VALUES ('$namaProduk', '$hargaProduk', '$deskripsiProduk', '$namaFileTujuan')";
            if ($conn->query($sql) === TRUE) {
                echo "Produk berhasil diupload.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Terjadi kesalahan saat mengupload file.";
        }
    } else {
        echo "Terjadi kesalahan saat mengupload file: " . $error;
    }
} else {
    echo "Terjadi kesalahan saat mengupload file.";
}

// Menutup koneksi ke database
$conn->close();
?>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no">
    <meta name="it-rating" content="it-rat-cd303c3f80473535b3c667d0d67a7a11">
    <meta name="cmsmagazine" content="3f86e43372e678604d35804a67860df7">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">
    <title>BeShop - Shop</title>
    <meta name='description' content="" />
    <meta name="keywords" content="" />
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/style2.css" />
</head>

<body class="loaded">

    <!-- BEGIN BODY -->

    <div class="main-wrapper">

        <!-- BEGIN CONTENT -->

        <main class="content">
            <!-- BEGIN DETAIL MAIN BLOCK -->
            <div class="detail-block detail-block_margin">
                <div class="wrapper">
                    <div class="detail-block__content">
                        <h1>Shop</h1>
                        <ul class="bread-crumbs">
                            <li class="bread-crumbs__item">
                                <a href="#" class="bread-crumbs__link">Home</a>
                            </li>
                            <li class="bread-crumbs__item">Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- DETAIL MAIN BLOCK EOF   -->

            <!-- PRODUK BOX -->
            <div class="produk-box">
                <!-- PHP CODE UNTUK MENAMPILKAN PRODUK -->
                <?php
                // Menampilkan produk menggunakan produk box
                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='produk-item'>";
                        echo "<img src='" . $row['gambarproduk'] . "' alt='Produk'>";
                        echo "<h3>" . $row['namaproduk'] . "</h3>";
                        echo "<p>" . $row['deskripsiproduk'] . "</p>";
                        echo "<span class='harga'>" . $row['hargaproduk'] . "</span>";
                        echo "</div>";
                    }
                } else {
                    echo "Tidak ada produk yang ditemukan.";
                }
                ?>
            </div>
            <!-- PRODUK BOX EOF -->

        </main>

        <!-- CONTENT EOF   -->

        <!-- BEGIN HEADER -->

        <header class="header">
            <div class="header-top">
                <span>Only Admin Can Use Login</span>
                <i class="header-top-close js-header-top-close icon-close"></i>
            </div>
            <div class="header-content">
                <div class="header-logo">
                    <img src="../admin/img/LOGO (7).png" alt="">
                </div>
                <div class="header-box">
                    <ul class="header-nav">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li><a href="login.html">Logout</a></li>
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