<!DOCTYPE html>
<html>
<head>
    <title>Update Product</title>
    <link rel="stylesheet" type="text/css" href="styles1.css">
</head>
<body>
    <h2>Update Product</h2>
    <!-- Update Product Form -->
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

    if (isset($_GET["id"])) {
        $update_id = $_GET["id"];
        $sql = "SELECT * FROM products WHERE id = $update_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            ?>
            <form method="POST" action="update_product_action.php" enctype="multipart/form-data">
            <input type="hidden" name="update_id" value="<?php echo $row["id"]; ?>">
            <label for="updated_product_name">Product Name:</label>
            <input type="text" name="updated_namaproduk" value="<?php echo $row["namaproduk"]; ?>" required>
            <br>
            <label for="updated_product_price">Product Price:</label>
            <input type="number" name="updated_hargaproduk" value="<?php echo $row["hargaproduk"]; ?>" required>
            <br>
            <label for="updated_product_description">Product Description:</label>
            <textarea name="updated_deskripsiproduk" required><?php echo $row["deskripsiproduk"]; ?></textarea>
            <br>
            <label for="updated_product_image">Product Image:</label>
            <input type="file" name="updated_gambarproduk" accept="image/*">
            <br>
            <input type="submit" value="Update">
            </form>
            <?php
            } else {
            echo "Product not found";
            }
            }   
            $conn->close();
?>

<a href="read_products.php" class="back-btn">Back to Product List</a>
</body>
</html>
