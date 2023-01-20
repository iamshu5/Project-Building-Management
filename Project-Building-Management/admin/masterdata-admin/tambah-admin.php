<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $nama_admin = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = password_hash( trim($_POST['password']), PASSWORD_BCRYPT );

    $cek_username = mysqli_query($koneksi, "SELECT id FROM admin WHERE username = '$username'");
    if( mysqli_num_rows($cek_username) > 0 ) {
        echo "<script>alert('Username sudah digunakan!!');</script>";

    } else {
        $tambah_admin = mysqli_query($koneksi, "INSERT INTO admin VALUES (NULL, '$nama_admin', '$username', '$password')");
        if( $tambah_admin ) {
            header('Location: data-admin.php');
            die;

        } else {
            echo "<script>alert('Data admin gagal ditambahkan!!');</script>";
        }
    }
}

$isActive = 'masterdata-admin';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-10 col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Tambah Data Admin</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-admin/data-admin.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="nama">Nama Admin</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Admin" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username Admin" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password Admin" required>
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