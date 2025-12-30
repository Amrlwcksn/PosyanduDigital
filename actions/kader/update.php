<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)$_POST['id'];
    $alamat_id = (int)$_POST['alamat_id'];
    $nama = $conn->real_escape_string($_POST['nama']);
    
    // Address data
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

    // Update Address First
    if (!empty($alamat_id)) {
        $sql_addr = "UPDATE alamat_kader SET jalan='$jalan', rt='$rt', rw='$rw', desa='$desa', kecamatan='$kecamatan', kabupaten='$kabupaten', provinsi='$provinsi', kode_pos='$kode_pos' WHERE id=$alamat_id";
        $conn->query($sql_addr);
    } else {
        // Fallback if ID is missing
        $sql_insert_addr = "INSERT INTO alamat_kader (jalan, rt, rw, desa, kecamatan, kabupaten, provinsi, kode_pos) VALUES ('$jalan', '$rt', '$rw', '$desa', '$kecamatan', '$kabupaten', '$provinsi', '$kode_pos')";
        $conn->query($sql_insert_addr);
        $alamat_id = $conn->insert_id;
    }

    $sql = "UPDATE kader SET nama='$nama', alamat_kader_id='$alamat_id', no_hp='$no_hp', jabatan='$jabatan', aktif='$aktif' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_kader', 'Kader berhasil diupdate.');
        header("Location: ../../views/kader/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
