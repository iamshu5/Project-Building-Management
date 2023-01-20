<?php
require '../../config.php';
$id_admin = $_GET['id'] ?? '';

mysqli_query($koneksi, "DELETE FROM admin WHERE id = '$id_admin'");
header('Location: data-admin.php');