<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_gedung = $_GET['id'] ?? '';
$cek_gedung = mysqli_query($koneksi, "SELECT * FROM gedung WHERE id = '$id_gedung'");
$data_gedung = mysqli_fetch_assoc($cek_gedung);

$isActive = 'masterdata-gedung';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-10 col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Detail Data Gedung</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-gedung/data-gedung.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="nama">Nama Gedung</label>
                        <input type="text" id="nama" class="form-control" value="<?= $data_gedung['nama_gedung'] ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="nama-pic">Nama Penanggung Jawab</label>
                        <input type="text" id="nama-pic" class="form-control" value="<?= $data_gedung['nama_pic'] ?>" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="nohp-pic">Nomor HP Penanggung Jawab</label>
                        <input type="text" id="nohp-pic" class="form-control" value="<?= $data_gedung['nohp_pic'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="alamat-pic">Alamat Penanggung Jawab</label>
                        <textarea id="alamat-pic" rows="5" class="form-control" readonly><?= $data_gedung['alamat_pic'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="luas-tanah">Luas Tanah</label>
                        <input type="text" id="luas-tanah" class="form-control" value="<?= $data_gedung['luas_tanah'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="tahun-berdiri">Tahun Berdiri</label>
                        <input type="text" id="tahun-berdiri" class="form-control" value="<?= $data_gedung['tahun_berdiri'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" rows="5" class="form-control" readonly><?= $data_gedung['alamat'] ?></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
</body>
</html>