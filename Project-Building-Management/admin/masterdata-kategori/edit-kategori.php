<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_kategori = $_GET['id'] ?? '';
$cek_kategori = mysqli_query($koneksi, "SELECT * FROM kategori_asset WHERE id = '$id_kategori'");
$data_kategori = mysqli_fetch_assoc($cek_kategori);

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $nama_kategori = trim($_POST['kategori']);
    $edit_kategori = mysqli_query($koneksi, "UPDATE kategori_asset SET nama_kategori = '$nama_kategori' WHERE id = '$id_kategori'");
    if( $edit_kategori ) {
        echo "<script>
            alert('Data kategori berhasil diperbarui');
            location.href = location.href;
        </script>";

    } else {
        echo "<script>alert('Data kategori gagal diperbarui!!');</script>";
    }
}

$isActive = 'masterdata-kategori';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Edit Data Kategori</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-kategori/data-kategori.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" id="id" name="id" class="form-control" value="<?= $id_kategori ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="kategori">Nama Kategori</label>
                        <input type="text" id="kategori" name="kategori" class="form-control" value="<?= $data_kategori['nama_kategori'] ?>" placeholder="Nama Kategori" required>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success shadow-sm">
                            Submit
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