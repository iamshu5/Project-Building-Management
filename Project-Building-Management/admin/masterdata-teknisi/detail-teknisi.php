<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_teknisi = $_GET['id'] ?? '';
$cek_teknisi = mysqli_query($koneksi, "SELECT * FROM teknisi WHERE id = '$id_teknisi'");
$data_teknisi = mysqli_fetch_assoc($cek_teknisi);

$isActive = 'masterdata-teknisi';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-7">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Detail Data Teknisi</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-teknisi/data-teknisi.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" id="id" class="form-control" value="<?= $id_teknisi ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama-teknisi">Nama Teknisi</label>
                        <input type="text" id="nama-teknisi" class="form-control" value="<?= $data_teknisi['nama_teknisi'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="bagian">Bagian</label>
                        <input type="text" id="bagian" class="form-control" value="<?= $data_teknisi['nama_bagian'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" class="form-control" value="<?= $data_teknisi['nik'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" id="nip" class="form-control" value="<?= $data_teknisi['nip'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama-pt">Nama PT</label>
                        <input type="text" id="nama-pt" class="form-control" value="<?= $data_teknisi['nama_pt'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" class="form-control" readonly><?= $data_teknisi['alamat'] ?></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
</body>
</html>