<?php
include '../../includes/header.php';
include '../../includes/functions.php';
check_login();
require_once '../../connections/conn.php';
?>

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
    <h2>Riwayat Transaksi Logistik</h2>
    <a href="create.php" class="btn btn-primary">+ Tambah Transaksi</a>
</div>

<?php flash_message('msg_transaksi'); ?>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Barang</th>
            <th>Kader</th>
            <th>Jenis Transaksi</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT lt.*, l.nama_barang, k.nama as nama_kader 
                FROM logistik_transaksi lt 
                JOIN logistik l ON lt.logistik_id = l.id 
                JOIN kader k ON lt.kader_id = k.id 
                ORDER BY lt.tanggal DESC";
        $result = $conn->query($sql);
        $no = 1;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $jenis = ($row['jenis_transaksi'] == 1) ? '<span class="badge badge-success" style="color:green">Masuk</span>' : '<span class="badge badge-danger" style="color:red">Keluar</span>';
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                echo "<td>" . htmlspecialchars($row['nama_kader']) . "</td>";
                echo "<td>" . $jenis . "</td>";
                echo "<td>" . $row['jumlah'] . "</td>";
                echo "<td>" . htmlspecialchars($row['keterangan']) . "</td>";
                echo "<td>
                        <a href='../../actions/logistik_transaksi/delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus transaksi ini? Stok akan dikembalikan.\")'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8' style='text-align:center'>Tidak ada data</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include '../../includes/footer.php'; ?>
