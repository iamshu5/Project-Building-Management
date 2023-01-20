<?php
require '../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../logout.php');
    die;
}

$total_gedung = mysqli_query($koneksi, "SELECT COUNT(id) AS total FROM gedung");
$total_gedung = mysqli_fetch_assoc($total_gedung);

$total_asset = mysqli_query($koneksi, "SELECT COUNT(id) AS total FROM asset_gedung");
$total_asset = mysqli_fetch_assoc($total_asset);

$total_laporan = mysqli_query($koneksi, "SELECT COUNT(id) AS total FROM laporan");
$total_laporan = mysqli_fetch_assoc($total_laporan);

$total_teknisi = mysqli_query($koneksi, "SELECT COUNT(id) AS total FROM teknisi");
$total_teknisi = mysqli_fetch_assoc($total_teknisi);

$isActive = 'dashboard'; 
include 'partials/header.php'; 
?>

<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Gedung
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format($total_gedung['total'] ?? 0, 0, ',', '.') ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-building fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Asset
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format($total_asset['total'] ?? 0, 0, ',', '.') ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-folder fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total laporan
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format($total_laporan['total'] ?? 0, 0, ',', '.') ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Teknisi
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?= number_format($total_teknisi['total'] ?? 0, 0, ',', '.') ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary text-white">
                <h5 class="card-title mb-0">Laporan Hari Ini</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Lokasi</th>
                                <th>Waktu</th>
                                <th>Permasalahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cek_laporan_hari_ini = mysqli_query($koneksi, "SELECT * FROM laporan WHERE DATE(waktu) = DATE(NOW())");
                            while( $data_laporan_hari_ini = mysqli_fetch_assoc($cek_laporan_hari_ini) ) {
                            ?>
                                <tr>
                                    <td><?= $data_laporan_hari_ini['id'] ?></td>
                                    <td>
                                        <a href="javascript:fotoLaporan('<?= $data_laporan_hari_ini['id'] ?>');" class="text-primary">klik</a>
                                    </td>
                                    <td><?= $data_laporan_hari_ini['lokasi'] ?></td>
                                    <td><?= $data_laporan_hari_ini['waktu'] ?></td>
                                    <td><?= $data_laporan_hari_ini['judul_masalah'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>