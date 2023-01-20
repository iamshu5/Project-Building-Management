<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    if( empty($_FILES['foto']['name']) ) {
        echo "<script>alert('Foto profile teknisi wajib di upload!!');</script>";
    } else {
        $username = trim($_POST['username']);
        $password = password_hash( trim($_POST['password']), PASSWORD_BCRYPT );
        $nama = trim($_POST['nama']);
        $no_telp = trim($_POST['no-telp']);
        $nama_bagian = trim($_POST['bagian']);
        $nik = trim($_POST['nik']);
        $nip = trim($_POST['nip']);
        $nama_pt = trim($_POST['nama-pt']);
        $alamat = trim($_POST['alamat']);

        move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/teknisi/' . $_FILES['foto']['name']);
        $foto = $_FILES['foto']['name'];

        $tambah_teknisi = mysqli_query($koneksi, "INSERT INTO teknisi VALUES (NULL, '$username', '$password', '$nama', '$no_telp', '$foto', '$nik', '$nip', '$nama_pt', '$nama_bagian', '$alamat')");
        if( $tambah_teknisi ) {
            header('Location: data-teknisi.php');
            die;

        } else {
            echo "<script>alert('Data teknisi gagal ditambahkan!!');</script>";
        }
    }
}

$isActive = 'masterdata-teknisi';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-7">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Tambah Data Teknisi</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-teknisi/data-teknisi.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Teknisi</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Teknisi" required>
                    </div>

                    <div class="form-group">
                        <label for="no-telp">No Telepon</label>
                        <input type="number" id="no-telp" name="no-telp" class="form-control" placeholder="No Telepon" required>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Profile</label>
                        <input type="file" id="foto" name="foto" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="bagian">Bagian</label>
                        <input type="text" id="bagian" name="bagian" class="form-control" placeholder="Bagian Kerja" required>
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" required>
                    </div>

                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" required>
                    </div>

                    <div class="form-group">
                        <label for="nama-pt">Nama PT</label>
                        <input type="text" id="nama-pt" name="nama-pt" class="form-control" placeholder="Nama PT Asal" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="5" class="form-control" placeholder="Alamat" required></textarea>
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