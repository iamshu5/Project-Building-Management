<?php
require '../../config.php';

$id_maintenance = $_GET['id'] ?? '';

$cek_laporan = mysqli_query($koneksi, "SELECT foto FROM laporan WHERE id_maintenance = '$id_maintenance'");
if( mysqli_num_rows($cek_laporan) > 0 ) {
    while( $data_laporan = mysqli_fetch_assoc($cek_laporan) ) {
        $data_laporan['foto'] = json_decode($data_laporan['foto'], true);
        
        foreach( $data_laporan['foto'] as $foto ) {
            @unlink('../../assets/img/laporan/' . $foto);
        }
    }

    mysqli_query($koneksi, "DELETE FROM laporan WHERE id_maintenance = '$id_maintenance'");
}

mysqli_query($koneksi, "DELETE FROM maintenance WHERE id = '$id_maintenance'");
header('Location: data-maintenance.php');