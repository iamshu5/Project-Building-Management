<?php
require '../../config.php';

$id_laporan = $_GET['id'] ?? '';

$cek_laporan = mysqli_query($koneksi, "SELECT foto FROM laporan WHERE id = '$id_laporan'");
if( mysqli_num_rows($cek_laporan) > 0 ) {
    while( $data_laporan = mysqli_fetch_assoc($cek_laporan) ) {
        $data_laporan['foto'] = json_decode($data_laporan['foto'], true);
        
        foreach( $data_laporan['foto'] as $foto ) {
            @unlink('../../assets/img/laporan/' . $foto);
        }
    }
}

mysqli_query($koneksi, "DELETE FROM laporan WHERE id = '$id_laporan'");
header('Location: data-laporan.php');