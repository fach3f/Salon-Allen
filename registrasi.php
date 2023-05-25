<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dballen";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Inisialisasi pesan error
$error_message = "";

// Memeriksa apakah form registrasi dikirimkan
if (isset($_POST['register'])) {
    // Mendapatkan nilai inputan dari form
    $name = $_POST['name'];
    $lastname = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mendefinisikan role berdasarkan jenis form registrasi
    $role = ""; // Inisialisasi role kosong
    if (isset($_POST['admin_registration'])) {
        $role = "admin"; // Jika admin_registration di-set, maka role diatur sebagai "admin"
    } else {
        $role = "user"; // Jika admin_registration tidak di-set, maka role diatur sebagai "user"
    }

    // Membuat query untuk menyimpan data registrasi ke dalam tabel pengguna
    $sql = "INSERT INTO users (name, lastname, phone, email, password, role) VALUES ('$name', '$lastname', '$phone', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        // Registrasi berhasil
        // Mengatur URL redirect dengan parameter registration_success
        header("Location: registration.html?registration_success=true");
        exit();
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
}

// Menutup koneksi ke database
$conn->close();
?>
