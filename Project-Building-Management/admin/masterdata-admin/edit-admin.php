<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_admin = $_GET['id'] ?? '';
$cek_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE id = '$id_admin'");
$data_admin = mysqli_fetch_assoc($cek_admin);

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $nama = trim($_POST['nama']);
    $password = !empty($_POST['password']) ? trim($_POST['password']) : $data_admin['password'];

    $edit_admin = mysqli_query($koneksi, "UPDATE admin SET nama = '$nama', password = '$password' WHERE id = '$id_admin'");
    if( $edit_admin ) {
        echo "<script>
            alert('Data admin berhasil diperbarui');
            location.href = location.href;
        </script>";

    } else {
        echo "<script>alert('Data admin gagal diperbarui!!');</script>";
    }
}

$isActive = 'masterdata-admin';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-10 col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Edit Data Admin</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-admin/data-admin.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="nama">Nama Admin</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?= $data_admin['nama'] ?>" placeholder="Nama Admin" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" value="<?= $data_admin['username'] ?>" placeholder="Username Admin" readonly>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Diisi jika ingin diubah">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            Simpan Perubahan
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