<?php
require '../../config.php';

$id_teknisi = $_GET['id'] ?? '';
$cek_teknisi = mysqli_query($koneksi, "SELECT foto_profile FROM teknisi WHERE id = '$id_teknisi'");
if( mysqli_num_rows($cek_teknisi) > 0 ) {
    $data_teknisi = mysqli_fetch_assoc($cek_teknisi);
    @unlink('../../assets/img/teknisi/' . $data_teknisi['foto_profile']);
}

mysqli_query($koneksi, "DELETE FROM teknisi WHERE id = '$id_teknisi'");
header('Location: data-teknisi.php');