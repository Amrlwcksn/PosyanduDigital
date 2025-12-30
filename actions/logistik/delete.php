<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM logistik WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_logistik', 'Barang berhasil dihapus.');
    } else {
        $_SESSION['msg_logistik'] = "Error: " . $conn->error;
        $_SESSION['msg_logistik_class'] = "alert alert-danger";
    }
}
header("Location: ../../views/logistik/index.php");
?>
