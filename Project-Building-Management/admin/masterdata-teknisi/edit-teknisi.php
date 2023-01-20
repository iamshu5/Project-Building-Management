<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_teknisi = $_GET['id'] ?? '';
$cek_teknisi = mysqli_query($koneksi, "SELECT * FROM teknisi WHERE id = '$id_teknisi'");
$data_teknisi = mysqli_fetch_assoc($cek_teknisi);

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $username = trim($_POST['username']);
    $password = !empty($_POST['password'])
        ? password_hash( trim($_POST['password']), PASSWORD_BCRYPT )
        : $data_teknisi['password'];
    $nama = trim($_POST['nama']);
    $no_telp = trim($_POST['no-telp']);
    $nama_bagian = trim($_POST['bagian']);
    $nik = trim($_POST['nik']);
    $nip = trim($_POST['nip']);
    $nama_pt = trim($_POST['nama-pt']);
    $alamat = trim($_POST['alamat']);
    $foto = $data_teknisi['foto_profile'];

    if( !empty($_FILES['foto']['name']) ) {
        @unlink('../../assets/img/teknisi/' . $foto);
        move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/teknisi/' . $_FILES['foto']['name']);
        $foto = $_FILES['foto']['name'];
    }

    $edit_teknisi = mysqli_query($koneksi, "UPDATE teknisi SET nama_teknisi = '$nama', password = '$password', no_telp = '$no_telp', foto_profile = '$foto', nik = '$nik', nip = '$nip', nama_pt = '$nama_pt', alamat = '$alamat' WHERE id = '$id_teknisi'");
    if( $edit_teknisi ) {
        echo "<script>
            alert('Data teknisi berhasil diperbarui');
            location.href = location.href;
        </script>";

    } else {
        echo "<script>alert('Data kategori gagal diperbarui!!');</script>";
    }
}

$isActive = 'masterdata-teknisi';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-7">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Edit Data Teknisi</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-teknisi/data-teknisi.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" id="id" class="form-control" value="<?= $id_teknisi ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?= $data_teknisi['username'] ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Isi jika ingin diubah">
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Teknisi</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Teknisi" value="<?= $data_teknisi['nama_teknisi'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="no-telp">No Telepon</label>
                        <input type="number" id="no-telp" name="no-telp" class="form-control" placeholder="No Telepon" value="<?= $data_teknisi['no_telp'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Profile</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="bagian">Bagian</label>
                        <input type="text" id="bagian" name="bagian" class="form-control" placeholder="Bagian Kerja" value="<?= $data_teknisi['nama_bagian'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" value="<?= $data_teknisi['nik'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="<?= $data_teknisi['nip'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nama-pt">Nama PT</label>
                        <input type="text" id="nama-pt" name="nama-pt" class="form-control" placeholder="Nama PT Asal" value="<?= $data_teknisi['nama_pt'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="5" class="form-control" placeholder="Alamat" required><?= $data_teknisi['alamat'] ?></textarea>
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