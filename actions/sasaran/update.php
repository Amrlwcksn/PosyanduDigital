<?php
session_start();
require_once '../../connections/conn.php';
require_once '../../includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int) $_POST['id'];
    $alamat_id = (int) $_POST['alamat_id'];
    $nama = $conn->real_escape_string($_POST['nama']);
    $nik = $conn->real_escape_string($_POST['nik']);
    $tanggal_lahir = $conn->real_escape_string($_POST['tanggal_lahir']);
    
    // Address data
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

    // Update Address First
    if (!empty($alamat_id)) {
        $sql_addr = "UPDATE alamat_sasaran SET jalan='$jalan', rt='$rt', rw='$rw', desa='$desa', kecamatan='$kecamatan', kabupaten='$kabupaten' WHERE id=$alamat_id";
        $conn->query($sql_addr);
    } else {
        // Fallback if somehow missing ID (create new)
        $sql_insert_addr = "INSERT INTO alamat_sasaran (jalan, rt, rw, desa, kecamatan, kabupaten) VALUES ('$jalan', '$rt', '$rw', '$desa', '$kecamatan', '$kabupaten')";
        $conn->query($sql_insert_addr);
        $alamat_id = $conn->insert_id;
    }

    $sql = "UPDATE sasaran SET 
            nama='$nama', 
            nik='$nik', 
            tanggal_lahir='$tanggal_lahir', 
            alamat_sasaran_id='$alamat_id',
            jenis_kelamin='$jenis_kelamin', 
            jenis_sasaran='$jenis_sasaran', 
            nama_wali='$nama_wali', 
            no_hp_wali='$no_hp_wali' 
            WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        flash_message('msg_sasaran', 'Data sasaran berhasil diupdate.');
        header("Location: ../../views/sasaran/index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
