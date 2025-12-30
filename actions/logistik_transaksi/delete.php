<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Get transaction details first to reverse stock
    $trans = $conn->query("SELECT * FROM logistik_transaksi WHERE id=$id")->fetch_assoc();
    
    if($trans) {
        $lid = $trans['logistik_id'];
        $jml = $trans['jumlah'];
        $jenis = $trans['jenis_transaksi'];

        $sql = "DELETE FROM logistik_transaksi WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            // Reverse Stock
            // If was Masuk (1), now decrease. If was Keluar (2), now increase.
            if ($jenis == 1) {
                $conn->query("UPDATE logistik SET stok = stok - $jml WHERE id=$lid");
            } else {
                $conn->query("UPDATE logistik SET stok = stok + $jml WHERE id=$lid");
            }

            flash_message('msg_transaksi', 'Transaksi dihapus dan stok dikembalikan.');
        } else {
            $_SESSION['msg_transaksi'] = "Error: " . $conn->error;
            $_SESSION['msg_transaksi_class'] = "alert alert-danger";
        }
    }
}
header("Location: ../../views/logistik_transaksi/index.php");
?>
