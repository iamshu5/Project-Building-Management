<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$isActive = 'masterdata-kategori';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Data Kategori Asset</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-kategori/tambah-kategori.php" class="btn btn-success btn-sm shadow">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cek_kategori_asset = mysqli_query($koneksi, "SELECT * FROM kategori_asset");
                            while( $data_kategori_asset = mysqli_fetch_assoc($cek_kategori_asset) ) {
                            ?>
                                <tr>
                                    <td><?= $data_kategori_asset['id'] ?></td>
                                    <td><?= $data_kategori_asset['nama_kategori'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <a class="dropdown-item text-primary" href="<?= URL_WEB ?>admin/masterdata-kategori/edit-kategori.php?id=<?= $data_kategori_asset['id'] ?>">Edit</a>
                                                <a class="dropdown-item text-danger" href="javascript:hapusData('masterdata-kategori/delete-kategori.php?id=<?= $data_kategori_asset['id'] ?>', 'kategori');">Delete</a>
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