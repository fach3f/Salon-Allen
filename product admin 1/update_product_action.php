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

// Handle form submission - Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_id"])) {
    $update_id = $_POST["update_id"];
    $updated_namaproduk = $_POST["updated_namaproduk"];
    $updated_hargaproduk = $_POST["updated_hargaproduk"];
    $updated_deskripsiproduk = $_POST["updated_deskripsiproduk"];
    $updated_gambarproduk = $_FILES["updated_gambarproduk"]["name"];

    // Move the updated image file to the same directory
    $target_dir = "gambarproduk/";
    $target_file = $target_dir . basename($updated_gambarproduk);
    move_uploaded_file($_FILES["updated_gambarproduk"]["tmp_name"], $target_file);

    // Prepare SQL statement to update the product
    $sql = "UPDATE products SET namaproduk = '$updated_namaproduk', hargaproduk = $updated_hargaproduk, deskripsiproduk = '$updated_deskripsiproduk', gambarproduk = '$updated_gambarproduk' WHERE id = $update_id";

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
