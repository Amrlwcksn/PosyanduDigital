<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Data Kegiatan Posyandu</h2>
    <a href="create.php" class="btn btn-primary">+ Tambah Kegiatan</a>
</div>

<?php flash_message('msg_kegiatan'); ?>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Dibuat Oleh</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT k.*, u.username as creator_name FROM kegiatan_posyandu k 
                LEFT JOIN users u ON k.created_by = u.id 
                ORDER BY k.tanggal_kegiatan DESC";
        $result = $conn->query($sql);
        $no = 1;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal_kegiatan']) . "</td>";
                echo "<td>" . htmlspecialchars($row['lokasi']) . "</td>";
                echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                echo "<td>" . htmlspecialchars($row['creator_name']) . "</td>";
                echo "<td>
                        <a href='edit.php?id=" . $row['id'] . "' class='btn btn-warning'>Edit</a>
                        <a href='../../actions/kegiatan/delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Yakin hapus kegiatan ini?\")'>Hapus</a>
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
