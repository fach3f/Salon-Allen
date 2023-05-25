<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
<a href="../index.html" class="back-button">Back</a>
    <header>
    
        <h2>Product List</h2>
    </header>
    <!-- Product List -->
    <?php
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dballen";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve products from the database
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-box'>";
        echo "<img src='gambarproduk/" . $row["gambarproduk"] . "' class='gambarproduk'>";
        echo "<div class='namaproduk'>" . $row["namaproduk"] . "</div>";
        echo "<div class='hargaproduk'>Rp." . $row["hargaproduk"] . "</div>";
        echo "<div class='deskripsiproduk'>" . $row["deskripsiproduk"] . "</div>";
        echo "<div class='product-actions'>";
        echo "<form method='POST' action='delete_product_action.php'>";
        echo "<input type='hidden' name='delete_id' value='" . $row['id'] . "'>";
        echo "<input type='submit' name='delete_product' value='Delete' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this product?\")'>";
        echo "<a href='update_product.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    

    $conn->close();
    ?>
        <button onclick="window.location.href='create_product.php'" class="create-btn">+</button>
		<footer class="footer">
					<div class="footer-nav__col">
						<span class="footer-nav__col-title">Contact</span>
						<ul>
							<li><i class="icon-map-pin"></i> Jl.Cihanjuang No.11 , Kota Cimahi, Jawa Barat 40513</li>
							<li>
								<i class="icon-smartphone"></i>
								<div class="footer-nav__col-phones">
									<a href="tel:+13459971345">0815-7206-4004</a>
								</div>
							</li>
							<li><i class="icon-mail"></i><a href="mailto:info@beshop.com">alensalon14@gmail.com</a></li>
						</ul>
					</div>
				</div>
				<div class="footer-copy">
					<span>&copy; A ll rights reserved. Allen Salon 2023</span>
				</div>
			</div>
		</footer>

</body>
</html>
