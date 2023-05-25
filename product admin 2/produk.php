<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
    <link rel="stylesheet" type="text/css" href="styles1.css">
</head>
<body>
    <?php
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbsalon";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

        // Handle form submission - Create or Update
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if create form is submitted
            if (isset($_POST["create_product"])) {
            $product_name = $_POST["product_name"];
            $product_price = $_POST["product_price"];
            $product_quantity = $_POST["product_quantity"];
            $product_description = $_POST["product_description"];
            $product_image = $_FILES["product_image"]["name"];

            // Move the uploaded image file to a specific directory
            $target_dir = "product_images/";
            $target_file = $target_dir . basename($product_image);
            move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

            // Prepare SQL statement to insert the product into the database
            $sql = "INSERT INTO products (product_name, product_price, product_quantity, product_description, product_image) VALUES ('$product_name', $product_price, $product_quantity, '$product_description', '$product_image')";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            // Redirect to product list page
            header("Location: read_products.php");
            exit;
        } else {
            echo "Error creating product: " . $conn->error;
        }
    }

        // Check if update form is submitted
        if (isset($_POST["update_id"])) {
            $update_id = $_POST["update_id"];
            $updated_product_name = $_POST["updated_product_name"];
            $updated_product_price = $_POST["updated_product_price"];
            $updated_product_quantity = $_POST["updated_product_quantity"];
            $updated_product_description = $_POST["updated_product_description"];
            $updated_product_image = $_FILES["updated_product_image"]["name"];

            // Move the updated image file to the same directory
            $target_dir = "product_images/";
            $target_file = $target_dir . basename($updated_product_image);
            move_uploaded_file($_FILES["updated_product_image"]["tmp_name"], $target_file);

            // Prepare SQL statement to update the product
            $sql = "UPDATE products SET product_name = '$updated_product_name', product_price = $updated_product_price, product_quantity = $updated_product_quantity, product_description = '$updated_product_description', product_image = '$updated_product_image' WHERE id = $update_id";

            // Execute the SQL statement
            if ($conn->query($sql) === TRUE) {
                echo "<p class='success'>Product updated successfully</p>";
            } else {
                echo "<p class='error'>Error updating product: " . $conn->error . "</p>";
            }
        }
    }
    
// Handle delete operation
if (isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];

    // Prepare SQL statement to delete the product
    $sql = "DELETE FROM products WHERE id = $delete_id";

    // Execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}
    
    // Retrieve products from the database
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    ?>
    
    <h2>Create Product</h2>
    <!-- Create Product Form -->
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>
        <br>
        <label for="product_price">Product Price:</label>
        <input type="number" name="product_price" required>
        <br>
        <label for="product_quantity">Product Quantity:</label>
        <input type="number" name="product_quantity" required>
        <br>
        <label for="product_description">Product Description:</label>
        <textarea name="product_description" required></textarea>
        <br>
        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" accept="image/*" required>
        <br>
        <input type="submit" name="create_product" value="Create">
    </form>
    <a href="../Index Admin/index.php" class="back-btn">Back</a>

    <h2>Product List</h2>
    <!-- Product List -->
    <table>
    <!-- Loop through products data and generate table rows -->
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-box'>";
        echo "<img src='product_images/" . $row["product_image"] . "' class='product-image'>";
        echo "<div class='product-name'>" . $row["product_name"] . "</div>";
        echo "<div class='product-price'>Rp." . $row["product_price"] . "</div>";
        echo "<div class='product-description'>" . $row["product_description"] . "</div>";
        echo "<div class='product-actions'>";
        echo "<form method='POST' action='" . $_SERVER['PHP_SELF'] . "'>";
        echo "<input type='hidden' name='delete_id' value='" . $row['id'] . "'>";
        echo "<input type='submit' name='delete_product' value='Delete' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this product?\")'>";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?id=" . $row['id'] . "' class='edit-btn'>Edit</a>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
    }
    ?>
</table>


    
<h2>Update Product</h2>
<!-- Update Product Form -->
<?php
if (isset($_GET["id"])) {
    $update_id = $_GET["id"];
    $sql = "SELECT * FROM products WHERE id = $update_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
            <input type="hidden" name="update_id" value="<?php echo $row["id"]; ?>">
            <label for="updated_product_name">Product Name:</label>
            <input type="text" name="updated_product_name" value="<?php echo $row["product_name"]; ?>" required>
            <br>
            <label for="updated_product_price">Product Price:</label>
            <input type="number" name="updated_product_price" value="<?php echo $row["product_price"]; ?>" required>
            <br>
            <label for="updated_product_quantity">Product Quantity:</label>
            <input type="number" name="updated_product_quantity" value="<?php echo $row["product_quantity"]; ?>" required>
            <br>
            <label for="updated_product_description">Product Description:</label>
            <textarea name="updated_product_description" required><?php echo $row["product_description"]; ?></textarea>
            <br>
            <label for="updated_product_image">Product Image:</label>
            <input type="file" name="updated_product_image" accept="image/*">
            <br>
            <input type="submit" value="Update">
        </form>
<?php
    } else {
        echo "Product not found";
    }
}
?>
</body>
</html>
    