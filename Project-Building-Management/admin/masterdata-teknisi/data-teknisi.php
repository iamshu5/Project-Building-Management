<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$isActive = 'masterdata-teknisi';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Data Teknisi</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-teknisi/tambah-teknisi.php" class="btn btn-success btn-sm shadow">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Username</th>
                                <th>Nama Teknisi</th>
                                <th>Bagian</th>
                                <th>No Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cek_teknisi = mysqli_query($koneksi, "SELECT * FROM teknisi");
                            while( $data_teknisi = mysqli_fetch_assoc($cek_teknisi) ) {
                            ?>
                                <tr>
                                    <td><?= $data_teknisi['id'] ?></td>
                                    <td>
                                        <a style="cursor: pointer;" onclick="imageDetail('teknisi/<?= $data_teknisi['foto_profile'] ?>', 250);">
                                            <img src="<?= URL_WEB ?>assets/img/teknisi/<?= $data_teknisi['foto_profile'] ?>" height="50" alt="<?= $data_teknisi['username'] ?>">
                                        </a>
                                    </td>
                                    <td><?= $data_teknisi['username'] ?></td>
                                    <td><?= $data_teknisi['nama_teknisi'] ?></td>
                                    <td><?= $data_teknisi['nama_bagian'] ?></td>
                                    <td><?= $data_teknisi['no_telp'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <a class="dropdown-item text-info" href="<?= URL_WEB ?>admin/masterdata-teknisi/detail-teknisi.php?id=<?= $data_teknisi['id'] ?>">Detail</a>
                                                <a class="dropdown-item text-primary" href="<?= URL_WEB ?>admin/masterdata-teknisi/edit-teknisi.php?id=<?= $data_teknisi['id'] ?>">Edit</a>
                                                <a class="dropdown-item text-danger" href="javascript:hapusData('masterdata-teknisi/delete-teknisi.php?id=<?= $data_teknisi['id'] ?>', 'teknisi');">Delete</a>
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