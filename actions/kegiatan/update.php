<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $tgl = $_POST['tanggal_kegiatan'];
    $lokasi = $conn->real_escape_string($_POST['lokasi']);
    $ket = $conn->real_escape_string($_POST['keterangan']);

    $sql = "UPDATE kegiatan_posyandu SET tanggal_kegiatan='$tgl', lokasi='$lokasi', keterangan='$ket' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_kegiatan', 'Kegiatan berhasil diupdate.');
        header("Location: ../../views/kegiatan/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
