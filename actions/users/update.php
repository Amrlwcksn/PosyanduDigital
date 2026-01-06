<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $username = $conn->real_escape_string($_POST['username']);
    $role = (int)$_POST['role'];
    $password = $_POST['password'];
    if (!empty($password)) {
        // Hash the new password if provided
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$username', password='$password_hashed', role='$role' WHERE id=$id";
    } else {
        // Keep old password (already hashed in DB)
        $sql = "UPDATE users SET username='$username', role='$role' WHERE id=$id";
    }
    if ($conn->query($sql) === TRUE) {
        flash_message('msg_user', 'User berhasil diupdate.');
        header("Location: ../../views/users/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>