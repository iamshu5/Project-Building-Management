<?php
require '../../config.php';

$id_kategori = $_GET['id'] ?? '';
mysqli_query($koneksi, "DELETE FROM kategori_asset WHERE id = '$id_kategori'");

header('Location: data-kategori.php');