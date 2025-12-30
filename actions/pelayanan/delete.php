<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM pelayanan WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_pelayanan', 'Data pelayanan berhasil dihapus.');
    } else {
        $_SESSION['msg_pelayanan'] = "Error: " . $conn->error;
        $_SESSION['msg_pelayanan_class'] = "alert alert-danger";
    }
}
header("Location: ../../views/pelayanan/index.php");
?>
