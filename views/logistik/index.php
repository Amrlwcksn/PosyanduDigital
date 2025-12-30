<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Data Logistik</h2>
    <a href="create.php" class="btn btn-primary">+ Tambah Barang</a>
</div>

<?php flash_message('msg_logistik'); ?>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM logistik ORDER BY id DESC";
        $result = $conn->query($sql);
        $no = 1;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $jenis = ($row['jenis'] == 1) ? 'Obat' : (($row['jenis'] == 2) ? 'Vitamin' : 'Alat');
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                echo "<td>" . $jenis . "</td>";
                echo "<td>" . $row['stok'] . "</td>";
                echo "<td>" . htmlspecialchars($row['satuan']) . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a>
                        <a href='../../actions/logistik/delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Yakin hapus barang ini?\")'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' style='text-align:center'>Tidak ada data</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include '../../includes/footer.php'; ?>
