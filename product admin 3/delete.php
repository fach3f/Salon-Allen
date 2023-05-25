<?php
session_start();

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbsalon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete operation
if (isset($_GET["id"])) {
    $delete_id = $_GET["id"];

    // Prepare SQL statement to delete the product
    $sql = "DELETE FROM products WHERE id = $delete_id";

    // Execute the SQL statement
        // Execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            // Redirect to product list page
            header("Location: read_products.php");
            exit;
        } else {
            echo "Error Deleting product: " . $conn->error;
        }
}

// Close the database connection
$conn->close();

// Redirect back to the previous page
header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
?>
