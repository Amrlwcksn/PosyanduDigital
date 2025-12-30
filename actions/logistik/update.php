<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $nama = $conn->real_escape_string($_POST['nama_barang']);
    $jenis = (int)$_POST['jenis'];
    $stok = (int)$_POST['stok'];
    $satuan = $conn->real_escape_string($_POST['satuan']);

    $sql = "UPDATE logistik SET nama_barang='$nama', jenis='$jenis', stok='$stok', satuan='$satuan' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_logistik', 'Barang berhasil diupdate.');
        header("Location: ../../views/logistik/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
