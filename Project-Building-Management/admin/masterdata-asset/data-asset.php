<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_gedung = trim($_GET['id_gedung']);
$cek_gedung = mysqli_query($koneksi, "SELECT * FROM gedung WHERE id = '$id_gedung'");
$data_gedung = mysqli_fetch_assoc($cek_gedung);

$isActive = 'masterdata-gedung';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 d-flex align-items-center">
                    <span class="text-white mr-2">Data Asset</span> 
                    <span class="badge badge-pills bg-light"><?= $data_gedung['nama_gedung'] ?></span>
                </h5>
                <a href="<?= URL_WEB ?>admin/masterdata-asset/tambah-asset.php?id_gedung=<?= $id_gedung ?>" class="btn btn-success btn-sm shadow">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kategori</th>
                                <th>Nama Asset</th>
                                <th>Jumlah</th>
                                <th>Merk</th>
                                <th>Tgl Masuk</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cek_asset = mysqli_query($koneksi, "SELECT asset_gedung.*, kategori_asset.nama_kategori FROM asset_gedung LEFT JOIN kategori_asset ON kategori_asset.id = asset_gedung.id_kategori WHERE id_gedung = '$id_gedung'");
                            while( $data_asset = mysqli_fetch_assoc($cek_asset) ) {
                            ?>
                                <tr>
                                    <td><?= $data_asset['id'] ?></td>
                                    <td><?= $data_asset['nama_kategori'] ?></td>
                                    <td><?= $data_asset['nama_barang'] ?></td>
                                    <td><?= $data_asset['jumlah'] ?></td>
                                    <td><?= $data_asset['merk'] ?></td>
                                    <td><?= $data_asset['tgl_masuk'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <a class="dropdown-item text-primary" href="<?= URL_WEB ?>admin/masterdata-asset/edit-asset.php?id_gedung=<?= $id_gedung ?>&id_asset=<?= $data_asset['id'] ?>">Edit</a>
                                                <a class="dropdown-item text-danger" href="javascript:hapusData('masterdata-asset/delete-asset.php?id_gedung=<?= $id_gedung ?>&id_asset=<?= $data_asset['id'] ?>', 'asset');">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
</body>
</html>