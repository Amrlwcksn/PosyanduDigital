<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST['nama_barang']);
    $jenis = (int)$_POST['jenis'];
    $stok = (int)$_POST['stok'];
    $satuan = $conn->real_escape_string($_POST['satuan']);

    $sql = "INSERT INTO logistik (nama_barang, jenis, stok, satuan) VALUES ('$nama', '$jenis', '$stok', '$satuan')";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_logistik', 'Barang berhasil ditambahkan.');
        header("Location: ../../views/logistik/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
