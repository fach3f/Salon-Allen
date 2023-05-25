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

// Handle form submission - Create
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_product"])) {
    $namaproduk = $_POST["namaproduk"];
    $hargaproduk = $_POST["hargaproduk"];
    $deskripsiproduk = $_POST["deskripsiproduk"];
    $gambarproduk = $_FILES["gambarproduk"]["name"];

    // Move the uploaded image file to a specific directory
    $target_dir = "gambarproduk/";
    $target_file = $target_dir . basename($gambarproduk);
    move_uploaded_file($_FILES["gambarproduk"]["tmp_name"], $target_file);

    // Prepare SQL statement to insert the product into the database
    $sql = "INSERT INTO products (namaproduk, hargaproduk, deskripsiproduk, gambarproduk) VALUES ('$namaproduk', $hargaproduk, '$deskripsiproduk', '$gambarproduk')";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            // Redirect to product list page
            header("Location: read_products.php");
            exit;
        } else {
            echo "Error creating product: " . $conn->error;
        }
}

$conn->close();
?>
