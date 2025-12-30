<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $sql = "DELETE FROM sasaran WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_sasaran', 'Data sasaran berhasil dihapus.');
    } else {
        $_SESSION['msg_sasaran'] = "Error: " . $conn->error;
        $_SESSION['msg_sasaran_class'] = "alert alert-danger";
    }
}
header("Location: ../../views/sasaran/index.php");
?>
