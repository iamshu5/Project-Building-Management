<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$isActive = 'masterdata-maintenance';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Data Maintenance</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-maintenance/tambah-maintenance.php" class="btn btn-success btn-sm shadow">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Gedung</th>
                                <th>Teknisi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cek_maintenance = mysqli_query($koneksi, "SELECT maintenance.id, maintenance.judul, gedung.nama_gedung, teknisi.nama_bagian FROM maintenance LEFT JOIN gedung ON gedung.id = maintenance.id_gedung LEFT JOIN teknisi ON teknisi.id = maintenance.id_teknisi");
                            while( $data_maintenance = mysqli_fetch_assoc($cek_maintenance) ) {
                            ?>
                                <tr>
                                    <td><?= $data_maintenance['id'] ?></td>
                                    <td><?= $data_maintenance['judul'] ?></td>
                                    <td><?= $data_maintenance['nama_gedung'] ?></td>
                                    <td><?= $data_maintenance['nama_bagian'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <a class="dropdown-item text-primary" href="<?= URL_WEB ?>admin/masterdata-maintenance/detail-maintenance.php?id=<?= $data_maintenance['id'] ?>">Detail</a>
                                                <a class="dropdown-item text-danger" href="javascript:hapusData('masterdata-maintenance/delete-maintenance.php?id=<?= $data_maintenance['id'] ?>', 'maintenance');">Delete</a>
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