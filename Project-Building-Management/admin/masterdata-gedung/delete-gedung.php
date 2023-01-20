<?php
require '../../config.php';

$id_gedung = $_GET['id'] ?? '';
$cek_gedung = mysqli_query($koneksi, "SELECT foto FROM gedung WHERE id = '$id_gedung'");

if( mysqli_num_rows($cek_gedung) > 0 ) {
    $data_gedung = mysqli_fetch_assoc($cek_gedung);
    @unlink('../../assets/img/gedung/' . $data_gedung['foto']);

    mysqli_query($koneksi, "DELETE FROM asset_gedung WHERE id_gedung = '$id_gedung'");
}

$delete_gedung = mysqli_query($koneksi, "DELETE FROM gedung WHERE id = '$id_gedung'");
header('Location: data-gedung.php');