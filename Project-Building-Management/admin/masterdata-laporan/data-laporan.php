<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$isActive = 'masterdata-laporan';
include '../partials/header.php';
$id_gedung = trim($_GET['gedung'] ?? '');
?>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 mb-5">
        <div class="card shadow-lg">
            <div class="card-header bg-info">
                <h5 class="card-title mb-0 text-white">
                    <i class="fas fa-fw fa-search"></i>
                    Cari Data  Laporan
                </h5>
            </div>
            <div class="card-body">
                <form method="GET">
                    <div class="form-group">
                        <label for="gedung">Gedung</label>
                        <select id="gedung" name="gedung" class="form-control">
                            <option value="" selected disabled>- Pilih Salah Satu -</option>
                            <?php
                            $cek_gedung = mysqli_query($koneksi, "SELECT * FROM gedung");
                            while( $data_gedung = mysqli_fetch_assoc($cek_gedung) ) {
                            ?>
                                <option value="<?= $data_gedung['id'] ?>" <?= $data_gedung['id'] == $id_gedung ? 'selected' : '' ?>><?= $data_gedung['nama_gedung'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" class="form-control" name="tgl_awal" id="tanggal_awal">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" class="form-control" name="tgl_akhir" id="tanggal_akhir">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success shadow">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary">
                <h5 class="card-title mb-0 text-white">Data Laporan</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Maintenance</th>
                                <th>Lokasi</th>
                                <th>Waktu</th>
                                <th>Estimasi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $where_gedung = '1';
                            if( !empty($_GET['gedung']) ) {
                                $where_gedung = trim($_GET['gedung']);
                            }

                            $where_tgl_awal = '1';
                            if( !empty($_GET['tgl_awal']) ) {
                                $where_tgl_awal = trim($_GET['tgl_awal']);
                                $where_tgl_awal = "DATE(waktu) >= '$where_tgl_awal'";
                            }

                            $where_tgl_akhir = '1';
                            if( !empty($_GET['tgl_akhir']) ) {
                                $where_tgl_akhir = trim($_GET['tgl_akhir']);
                                $where_tgl_akhir = "DATE(waktu) <= '$where_tgl_akhir'";
                            }

                            $cek_laporan = mysqli_query($koneksi, "SELECT laporan.*, maintenance.judul AS judul_maintenance FROM laporan LEFT JOIN maintenance ON maintenance.id = laporan.id_maintenance WHERE maintenance.id_gedung = '$where_gedung' && $where_tgl_awal && $where_tgl_akhir");
                            while( $data_laporan = mysqli_fetch_assoc($cek_laporan) ) {
                            ?>
                                <tr>
                                    <td><?= $data_laporan['id'] ?></td>
                                    <td>
                                        <a style="cursor: pointer;" class="text-primary" onclick="fotoLaporan('<?= $data_laporan['id'] ?>');">
                                            Klik
                                        </a>
                                    </td>
                                    <td><?= $data_laporan['judul_maintenance'] ?></td>
                                    <td><?= $data_laporan['lokasi'] ?></td>
                                    <td><?= $data_laporan['waktu'] ?></td>
                                    <td><?= $data_laporan['estimasi'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownAction" data-toggle="dropdown" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <a class="dropdown-item text-primary" href="<?= URL_WEB ?>admin/masterdata-laporan/detail-laporan.php?id=<?= $data_laporan['id'] ?>">Detail</a>
                                                <a class="dropdown-item text-danger" href="javascript:hapusData('masterdata-laporan/delete-laporan.php?id=<?= $data_laporan['id'] ?>', 'laporan')">Delete</a>
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