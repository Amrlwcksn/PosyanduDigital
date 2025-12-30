<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tgl = $_POST['tanggal'];
    $lid = (int)$_POST['logistik_id'];
    $kid = (int)$_POST['kader_id'];
    $jenis = (int)$_POST['jenis_transaksi'];
    $jml = (int)$_POST['jumlah'];
    $ket = $conn->real_escape_string($_POST['keterangan']);

    // Check stock if outgoing
    if ($jenis == 2) {
        $check = $conn->query("SELECT stok FROM logistik WHERE id=$lid");
        $curr = $check->fetch_assoc();
        if ($curr['stok'] < $jml) {
            flash_message('msg_transaksi', 'Stok tidak mencukupi!', 'alert alert-danger');
            header("Location: ../../views/logistik_transaksi/create.php");
            exit;
        }
    }

    $sql = "INSERT INTO logistik_transaksi (logistik_id, kader_id, tanggal, jenis_transaksi, jumlah, keterangan) 
            VALUES ('$lid', '$kid', '$tgl', '$jenis', '$jml', '$ket')";

    if ($conn->query($sql) === TRUE) {
        // Update Master Stok
        if ($jenis == 1) {
            $conn->query("UPDATE logistik SET stok = stok + $jml WHERE id=$lid");
        } else {
            $conn->query("UPDATE logistik SET stok = stok - $jml WHERE id=$lid");
        }

        flash_message('msg_transaksi', 'Transaksi berhasil disimpan dan stok diupdate.');
        header("Location: ../../views/logistik_transaksi/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
