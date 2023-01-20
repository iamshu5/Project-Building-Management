<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $judul = trim($_POST['judul']);
    $gedung = trim($_POST['gedung']);
    $teknisi = trim($_POST['teknisi']);
    $detail = trim($_POST['detail']);

    $tambah_maintenance = mysqli_query($koneksi, "INSERT INTO maintenance VALUES (NULL, '$gedung', '$teknisi', '$judul', '$detail')");
    if( $tambah_maintenance ) {
        header('Location: data-maintenance.php');
        die;

    } else {
        echo "<script>alert('Data maintenance gagal ditambahkan!!');</script>";
    }
}

$isActive = 'masterdata-maintenance';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-10 col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Tambah Maintenance</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-maintenance/data-maintenance.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control" placeholder="Judul Maintenance" required>
                    </div>

                    <div class="form-group">
                        <label for="gedung">Gedung</label>
                        <select name="gedung" id="gedung" class="form-control" required>
                            <option value="" selected disabled>- Pilih Salah Satu -</option>
                            <?php
                            $cek_gedung = mysqli_query($koneksi, "SELECT * FROM gedung");
                            while( $data_gedung = mysqli_fetch_assoc($cek_gedung) ) {
                            ?>
                                <option value="<?= $data_gedung['id'] ?>"><?= $data_gedung['nama_gedung'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="teknisi">Teknisi</label>
                        <select name="teknisi" id="teknisi" class="form-control" required>
                            <option value="" selected disabled>- Pilih Salah Satu -</option>
                            <?php
                            $cek_teknisi = mysqli_query($koneksi, "SELECT * FROM teknisi");
                            while( $data_teknisi = mysqli_fetch_assoc($cek_teknisi) ) {
                            ?>
                                <option value="<?= $data_teknisi['id'] ?>"><?= $data_teknisi['nama_teknisi'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="detail">Detail</label>
                        <textarea rows="5" id="detail" name="detail" class="form-control" placeholder="Detail Maintenance" required></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            Submit Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
</body>
</html>