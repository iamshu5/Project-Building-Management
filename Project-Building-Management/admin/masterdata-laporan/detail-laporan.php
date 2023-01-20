<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_laporan = trim($_GET['id']);
$cek_laporan = mysqli_query($koneksi, "SELECT * FROM laporan WHERE id = '$id_laporan'");
$data_laporan = mysqli_fetch_assoc($cek_laporan);

$isActive = 'masterdata-laporan';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-7">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Detail Data Laporan</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-laporan/data-laporan.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" id="id" class="form-control" value="<?= $id_laporan ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="judul-permasalahan">Judul Permasalahan</label>
                        <input type="text" id="judul-permasalahan" class="form-control" value="<?= $data_laporan['judul_masalah'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi-permasalahan">Deskripsi Permasalahan</label>
                        <textarea rows="5" id="deskripsi-permasalahan" class="form-control" readonly><?= $data_laporan['deskripsi_masalah'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="solusi-permasalahan">Solusi Permasalahan</label>
                        <textarea rows="5" id="solusi-permasalahan" class="form-control" readonly><?= $data_laporan['deskripsi_masalah'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="estimasi">Estimasi Pengerjaan</label>
                        <input type="text" id="estimasi" class="form-control" value="<?= $data_laporan['estimasi'] ?>" readonly>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
</body>
</html>