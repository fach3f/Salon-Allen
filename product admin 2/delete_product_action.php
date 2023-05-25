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

// Handle delete operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];

    // Prepare SQL statement to delete the product
    $sql = "DELETE FROM products WHERE id = $delete_id";

        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            // Redirect to product list page
            header("Location: read_products.php");
            exit;
        } else {
            echo "Error Deleting product: " . $conn->error;
        }
}

$conn->close();
?>
