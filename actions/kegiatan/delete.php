<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    // Check dependency with pelayanan
    $check = $conn->query("SELECT * FROM pelayanan WHERE kegiatan_id = $id");
    if($check->num_rows > 0) {
        $_SESSION['msg_kegiatan'] = "Gagal hapus: Terdapat data pelayanan pada kegiatan ini.";
        $_SESSION['msg_kegiatan_class'] = "alert alert-danger";
    } else {
        $sql = "DELETE FROM kegiatan_posyandu WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            flash_message('msg_kegiatan', 'Kegiatan berhasil dihapus.');
        } else {
            $_SESSION['msg_kegiatan'] = "Error: " . $conn->error;
            $_SESSION['msg_kegiatan_class'] = "alert alert-danger";
        }
    }
}
header("Location: ../../views/kegiatan/index.php");
?>
