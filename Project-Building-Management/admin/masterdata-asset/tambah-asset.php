<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_gedung = trim($_GET['id_gedung']);
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $id_kategori = trim($_POST['kategori']);
    $nama_asset = trim($_POST['nama']);
    $jumlah = trim($_POST['jumlah']);
    $merk = trim($_POST['merk']);
    $tgl_masuk = date('Y-m-d');

    $tambah_asset = mysqli_query($koneksi, "INSERT INTO asset_gedung VALUES (NULL, '$id_gedung', '$id_kategori', '$nama_asset', '$jumlah', '$merk', '$tgl_masuk')");
    if( $tambah_asset ) {
        header('Location: data-asset.php?id_gedung=' . $id_gedung);
        die;

    } else {
        echo "<script>alert('Data asset gagal ditambahkan!!');</script>";
    }
}

$isActive = 'masterdata-gedung';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-10 col-md-8">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Tambah Data Asset</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-asset/data-asset.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="" selected disabled>- Pilih Salah Satu -</option>
                            <?php
                            $cek_kategori = mysqli_query($koneksi, "SELECT * FROM kategori_asset");
                            while( $data_kategori = mysqli_fetch_assoc($cek_kategori) ) {
                            ?>
                                <option value="<?= $data_kategori['id'] ?>"><?= $data_kategori['nama_kategori'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Asset</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Gedung" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah Asset" required>
                    </div>

                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" id="merk" name="merk" class="form-control" placeholder="Nama Merk" required>
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