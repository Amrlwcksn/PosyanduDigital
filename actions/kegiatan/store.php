<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';
check_login(); // Ensure ID is available

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tgl = $_POST['tanggal_kegiatan'];
    $lokasi = $conn->real_escape_string($_POST['lokasi']);
    $ket = $conn->real_escape_string($_POST['keterangan']);
    $uid = $_SESSION['user_id'];

    $sql = "INSERT INTO kegiatan_posyandu (tanggal_kegiatan, lokasi, keterangan, created_by) 
            VALUES ('$tgl', '$lokasi', '$ket', '$uid')";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_kegiatan', 'Kegiatan berhasil ditambahkan.');
        header("Location: ../../views/kegiatan/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
