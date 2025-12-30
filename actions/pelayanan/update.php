<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $kegiatan = (int)$_POST['kegiatan_id'];
    $sasaran = (int)$_POST['sasaran_id'];
    $kader = (int)$_POST['kader_id'];
    $bb = (float)$_POST['berat_badan'];
    $tb = (float)$_POST['tinggi_badan'];
    $lil = !empty($_POST['lingkar_lengan']) ? (float)$_POST['lingkar_lengan'] : "NULL";
    $gizi = (int)$_POST['status_gizi'];
    $imun = $conn->real_escape_string($_POST['imunisasi']);
    $vit = $conn->real_escape_string($_POST['vitamin']);
    $cat = $conn->real_escape_string($_POST['catatan']);

    $sql = "UPDATE pelayanan SET kegiatan_id='$kegiatan', sasaran_id='$sasaran', kader_id='$kader', 
            berat_badan='$bb', tinggi_badan='$tb', lingkar_lengan=$lil, status_gizi='$gizi', 
            imunisasi='$imun', vitamin='$vit', catatan='$cat' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_pelayanan', 'Data pelayanan berhasil diupdate.');
        header("Location: ../../views/pelayanan/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
