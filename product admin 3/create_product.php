<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
    <link rel="stylesheet" type="text/css" href="styles1.css">
</head>
<body>
    <h2>Create Product</h2>
    <!-- Create Product Form -->
    <form method="POST" action="create_product_action.php" enctype="multipart/form-data">
        <label for="namaproduk">Product Name:</label>
        <input type="text" name="namaproduk" required>
        <br>
        <label for="hargaproduk">Product Price:</label>
        <input type="number" name="hargaproduk" required>
        <br>
        <label for="deskripsiproduk">Product Description:</label>
        <textarea name="deskripsiproduk" required></textarea>
        <br>
        <label for="gambarproduk">Product Image:</label>
        <input type="file" name="gambarproduk" accept="image/*" required>
        <br>
        <input type="submit" name="create_product" value="Create">
    </form>
    <a href="read_products.php" class="back-btn">Back to Product List</a>
</body>
</html>
