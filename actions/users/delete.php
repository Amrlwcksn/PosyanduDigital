<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

// Only admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
    die("Akses ditolak");
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Prevent deleting self? or at least one admin?
    // For now, simple delete
    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_user', 'User berhasil dihapus.');
    } else {
        $_SESSION['msg_user'] = "Error: " . $conn->error;
        $_SESSION['msg_user_class'] = "alert alert-danger";
    }
}
header("Location: ../../views/users/index.php");
?>
