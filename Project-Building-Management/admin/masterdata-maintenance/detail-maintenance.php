<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_maintenance = $_GET['id'] ?? '';
$cek_maintenance = mysqli_query($koneksi, "SELECT maintenance.*, gedung.nama_gedung, teknisi.nama_bagian FROM maintenance LEFT JOIN gedung ON gedung.id = maintenance.id_gedung LEFT JOIN teknisi ON teknisi.id = maintenance.id_teknisi WHERE maintenance.id = '$id_maintenance'");
$data_maintenance = mysqli_fetch_assoc($cek_maintenance);

$isActive = 'masterdata-maintenance';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-10 col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Detail Maintenance</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-maintenance/data-maintenance.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" id="judul" class="form-control" value="<?= $data_maintenance['judul'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="gedung">Gedung</label>
                    <input type="text" id="gedung" class="form-control" value="<?= $data_maintenance['nama_gedung'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="teknisi">Teknisi</label>
                    <input type="text" id="teknisi" class="form-control" value="<?= $data_maintenance['nama_bagian'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="detail">Detail</label>
                    <textarea rows="5" id="detail" class="form-control" readonly><?= $data_maintenance['detail'] ?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
</body>
</html>