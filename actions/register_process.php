<?php
session_start();
require_once '../connections/conn.php';
require_once '../includes/config.php';
require_once '../includes/functions.php';
if (!ALLOW_REGISTRATION) {
    die("Akses ditolak.");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 2; // Default role (misal: 2 untuk Kader/User biasa)
    // Cek apakah username sudah ada
    $check = $conn->query("SELECT id FROM users WHERE username = '$username'");
    if ($check->num_rows > 0) {
        $_SESSION['error'] = "Username sudah digunakan.";
        header("Location: ../register.php");
        exit;
    }
    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
        header("Location: ../login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>