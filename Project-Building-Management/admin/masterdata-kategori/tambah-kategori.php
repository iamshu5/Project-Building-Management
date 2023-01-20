<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $nama_kategori = trim($_POST['kategori']);
    $tambah_kategori = mysqli_query($koneksi, "INSERT INTO kategori_asset VALUES (NULL, '$nama_kategori')");
    if( $tambah_kategori ) {
        header('Location: data-kategori.php');
        die;

    } else {
        echo "<script>alert('Data kategori gagal ditambahkan!!');</script>";  
    }
}

$isActive = 'masterdata-kategori';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Tambah Data Kategori</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-kategori/data-kategori.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="kategori">Nama Kategori</label>
                        <input type="text" id="kategori" name="kategori" class="form-control" placeholder="Nama Kategori" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            Submit Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../partials/footer.php'; ?>
</body>
</html>