<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $sql = "INSERT INTO pelayanan (kegiatan_id, sasaran_id, kader_id, berat_badan, tinggi_badan, lingkar_lengan, status_gizi, imunisasi, vitamin, catatan) 
            VALUES ('$kegiatan', '$sasaran', '$kader', '$bb', '$tb', $lil, '$gizi', '$imun', '$vit', '$cat')";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_pelayanan', 'Data pelayanan berhasil disimpan.');
        header("Location: ../../views/pelayanan/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
