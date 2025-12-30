<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string($_POST['nama']);
    $jalan = $conn->real_escape_string($_POST['jalan']);
    $rt = $conn->real_escape_string($_POST['rt']);
    $rw = $conn->real_escape_string($_POST['rw']);
    $desa = $conn->real_escape_string($_POST['desa']);
    $kecamatan = $conn->real_escape_string($_POST['kecamatan']);
    $kabupaten = $conn->real_escape_string($_POST['kabupaten']);
    $provinsi = $conn->real_escape_string($_POST['provinsi']);
    $kode_pos = $conn->real_escape_string($_POST['kode_pos']);
    $no_hp = $conn->real_escape_string($_POST['no_hp']);
    $jabatan = (int)$_POST['jabatan'];
    $aktif = (int)$_POST['aktif'];

    // Cek atau simpan alamat untuk menghindari redundansi
    $sql_check_addr = "SELECT id FROM alamat_kader WHERE jalan='$jalan' AND rt='$rt' AND rw='$rw' AND desa='$desa' AND kecamatan='$kecamatan' AND kabupaten='$kabupaten' AND provinsi='$provinsi' AND kode_pos='$kode_pos'";
    $result_addr = $conn->query($sql_check_addr);

    if ($result_addr && $result_addr->num_rows > 0) {
        $row_addr = $result_addr->fetch_assoc();
        $alamat_id = $row_addr['id'];
    } else {
        $sql_insert_addr = "INSERT INTO alamat_kader (jalan, rt, rw, desa, kecamatan, kabupaten, provinsi, kode_pos) VALUES ('$jalan', '$rt', '$rw', '$desa', '$kecamatan', '$kabupaten', '$provinsi', '$kode_pos')";
        if ($conn->query($sql_insert_addr) === TRUE) {
            $alamat_id = $conn->insert_id;
        } else {
            echo "Error Alamat: " . $conn->error;
            exit;
        }
    }

    $sql = "INSERT INTO kader (nama, alamat_kader_id, no_hp, jabatan, aktif) VALUES ('$nama', '$alamat_id', '$no_hp', '$jabatan', '$aktif')";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_kader', 'Kader berhasil ditambahkan.');
        header("Location: ../../views/kader/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
