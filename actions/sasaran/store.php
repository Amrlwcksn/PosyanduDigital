<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST['nama']);
    $nik = $conn->real_escape_string($_POST['nik']);
    $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
    $jalan = $conn->real_escape_string($_POST['jalan']);
    $rt = $conn->real_escape_string($_POST['rt']);
    $rw = $conn->real_escape_string($_POST['rw']);
    $desa = $conn->real_escape_string($_POST['desa']);
    $kecamatan = $conn->real_escape_string($_POST['kecamatan']);
    $kabupaten = $conn->real_escape_string($_POST['kabupaten']);
    $jenis_kelamin = (int) $_POST['jenis_kelamin'];
    $jenis_sasaran = (int) $_POST['jenis_sasaran'];
    $nama_wali = $conn->real_escape_string($_POST['nama_wali']);
    $no_hp_wali = $conn->real_escape_string($_POST['no_hp_wali']);

    // Cek atau simpan alamat untuk menghindari redundansi
    $sql_check_addr = "SELECT id FROM alamat_sasaran WHERE jalan='$jalan' AND rt='$rt' AND rw='$rw' AND desa='$desa' AND kecamatan='$kecamatan' AND kabupaten='$kabupaten'";
    $result_addr = $conn->query($sql_check_addr);

    if ($result_addr && $result_addr->num_rows > 0) {
        $row_addr = $result_addr->fetch_assoc();
        $alamat_id = $row_addr['id'];
    } else {
        $sql_insert_addr = "INSERT INTO alamat_sasaran (jalan, rt, rw, desa, kecamatan, kabupaten) VALUES ('$jalan', '$rt', '$rw', '$desa', '$kecamatan', '$kabupaten')";
        if ($conn->query($sql_insert_addr) === TRUE) {
            $alamat_id = $conn->insert_id;
        } else {
            echo "Error Alamat: " . $conn->error;
            exit;
        }
    }

    $sql = "INSERT INTO sasaran (nama, nik, tanggal_lahir, alamat_sasaran_id, jenis_kelamin, jenis_sasaran, nama_wali, no_hp_wali) 
            VALUES ('$nama', '$nik', '$tanggal_lahir', '$alamat_id', '$jenis_kelamin', '$jenis_sasaran', '$nama_wali', '$no_hp_wali')";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_sasaran', 'Data sasaran berhasil ditambahkan.');
        header("Location: ../../views/sasaran/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
