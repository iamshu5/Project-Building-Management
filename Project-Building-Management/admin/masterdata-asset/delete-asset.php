<?php
require '../../config.php';

$id_gedung = trim($_GET['id_gedung']);
$id_asset = trim($_GET['id_asset']);

mysqli_query($koneksi, "DELETE FROM asset_gedung WHERE id = '$id_asset'");
header('Location: data-asset.php?id_gedung=' . $id_gedung);