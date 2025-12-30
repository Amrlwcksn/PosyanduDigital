<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM kader WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_kader', 'Kader berhasil dihapus.');
    } else {
        $_SESSION['msg_kader'] = "Error: " . $conn->error; // Could fail if referenced in other tables
        $_SESSION['msg_kader_class'] = "alert alert-danger";
    }
}
header("Location: ../../views/kader/index.php");
?>
