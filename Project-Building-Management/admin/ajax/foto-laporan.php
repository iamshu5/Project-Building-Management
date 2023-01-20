<?php
require '../../config.php';

if( $_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST['id_laporan']) ) {
    echo 'Forbidden.';
}

$id_laporan = trim($_POST['id_laporan']);

$cek_laporan = mysqli_query($koneksi, "SELECT foto FROM laporan WHERE id = '$id_laporan'");
$data_laporan = mysqli_fetch_assoc($cek_laporan);

header('Content-Type: application/json');
echo $data_laporan['foto'] ?? '[]';