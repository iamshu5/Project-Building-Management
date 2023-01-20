<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$isActive = 'masterdata-gedung';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Data Gedung</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-gedung/tambah-gedung.php" class="btn btn-success btn-sm shadow">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Gedung</th>
                                <th>Nama Penanggung Jawab</th>
                                <th>Tahun Berdiri</th>
                                <th>Jumlah Asset</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cek_gedung = mysqli_query($koneksi, "SELECT * FROM gedung");
                            while( $data_gedung = mysqli_fetch_assoc($cek_gedung) ) {
                            ?>
                                <tr>
                                    <td><?= $data_gedung['id'] ?></td>
                                    <td><?= $data_gedung['nama_gedung'] ?></td>
                                    <td><?= $data_gedung['nama_pic'] ?></td>
                                    <td><?= $data_gedung['tahun_berdiri'] ?></td>
                                    <td><?= $data_gedung['luas_tanah'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <a class="dropdown-item text-success" href="<?= URL_WEB ?>admin/masterdata-asset/data-asset.php?id_gedung=<?= $data_gedung['id'] ?>">Data Asset</a>
                                                <a class="dropdown-item text-info" href="<?= URL_WEB ?>admin/masterdata-gedung/detail-gedung.php?id=<?= $data_gedung['id'] ?>">Detail</a>
                                                <a class="dropdown-item text-primary" href="<?= URL_WEB ?>admin/masterdata-gedung/edit-gedung.php?id=<?= $data_gedung['id'] ?>">Edit</a>
                                                <a class="dropdown-item text-danger" href="javascript:hapusData('masterdata-gedung/delete-gedung.php?id=<?= $data_gedung['id'] ?>', 'gedung');">Delete</a>
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