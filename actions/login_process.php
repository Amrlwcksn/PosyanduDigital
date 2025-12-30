<?php
session_start();
require_once '../connections/conn.php'; // Adjust path if needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // In a real app, use password_verify($password, $row['password'])
        // Assuming plain text for now as per "simple" request or if hashed, user needs to specify.
        // Let's implement simple check first. The DB schema said password VARCHAR(255).
        // WARNING: Using plain text comparison for simplicity as requested "simple", but should recommend hashing.
        
        if ($password == $row['password']) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['error'] = "Password salah!";
            header("Location: ../login.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan!";
        header("Location: ../login.php");
        exit;
    }
}
?>
