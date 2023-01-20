<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_gedung = trim($_GET['id_gedung']);
$id_asset = trim($_GET['id_asset']);

$cek_asset = mysqli_query($koneksi, "SELECT * FROM asset_gedung WHERE id = '$id_asset'");
$data_asset = mysqli_fetch_assoc($cek_asset);

$isActive = 'masterdata-gedung';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-10 col-md-8">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Edit Data Asset</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-asset/data-asset.php?id_gedung=<?= $id_gedung ?>" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" id="id" class="form-control" value="<?= $id_asset ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <?php
                            $cek_kategori = mysqli_query($koneksi, "SELECT * FROM kategori_asset");
                            while( $data_kategori = mysqli_fetch_assoc($cek_kategori) ) {
                            ?>
                                <option value="<?= $data_kategori['id'] ?>" <?= $data_kategori['id'] == $data_asset['id_kategori'] ? 'selected' : '' ?>><?= $data_kategori['nama_kategori'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Asset</label>
                        <input type="text" id="nama" class="form-control" placeholder="Nama Asset" value="<?= $data_asset['nama_barang'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" id="jumlah" class="form-control" placeholder="Jumlah Asset" value="<?= $data_asset['jumlah'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="merk">Merk</label>
                        <input type="text" id="merk" class="form-control" placeholder="Nama Merk" value="<?= $data_asset['merk'] ?>" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            Simpan Perubahan
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