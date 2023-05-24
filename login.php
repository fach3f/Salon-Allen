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

// Mendapatkan data yang dikirim dari form login
$email = $_POST['email'];
$password = $_POST['password'];

// Melakukan validasi data yang diterima

// Menghindari serangan SQL injection
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);

// Mengecek apakah email dan password cocok
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Login berhasil
    $row = $result->fetch_assoc();
    $role = $row['role']; // Mendapatkan nilai role dari tabel users

    // Mengarahkan role admin ke halaman admin/index.htm
    if ($role == 'admin') {
        header("Location: ../product admin/read_products.php?login_success=true");
        exit();
    }

    // Mengarahkan role user ke halaman user/index.html
    if ($role == 'user') {
        header("Location: shop.php?login_success=true");
        exit();
    }
} else {
    // Login gagal
    // Redirect pengguna kembali ke halaman login dengan parameter login_success false
    header("Location: login.php?login_success=false");
    exit();
}

// Menutup koneksi ke database
$conn->close();
?>
