<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$isActive = 'masterdata-admin';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Data Admin</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-admin/tambah-admin.php" class="btn btn-success btn-sm shadow">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cek_admin = mysqli_query($koneksi, "SELECT * FROM admin");
                            while( $data_admin = mysqli_fetch_assoc($cek_admin) ) {
                            ?>
                                <tr>
                                    <td><?= $data_admin['id'] ?></td>
                                    <td><?= $data_admin['nama'] ?></td>
                                    <td><?= $data_admin['username'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <a class="dropdown-item text-primary" href="<?= URL_WEB ?>admin/masterdata-admin/edit-admin.php?id=<?= $data_admin['id'] ?>">Edit</a>
                                                <a class="dropdown-item text-danger" onclick="javascript:hapusData('masterdata-admin/delete-admin.php?id=<?= $data_admin['id'] ?>', 'admin');">Delete</a>
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