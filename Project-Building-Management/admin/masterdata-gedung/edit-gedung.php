<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

$id_gedung = $_GET['id'] ?? '';
$cek_gedung = mysqli_query($koneksi, "SELECT * FROM gedung WHERE id = '$id_gedung'");
$data_gedung = mysqli_fetch_assoc($cek_gedung);

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $nama_gedung = trim($_POST['nama']);
    $nama_pic = trim($_POST['nama-pic']);
    $nohp_pic = trim($_POST['nohp-pic']);
    $alamat_pic = trim($_POST['alamat-pic']);
    $luas_tanah = trim($_POST['luas-tanah']);
    $tahun_berdiri = trim($_POST['tahun']);
    $alamat = trim($_POST['alamat']);

    $foto = $data_gedung['foto'];
    if( !empty($_FILES['foto']['name']) ) {
        @unlink('../../assets/img/gedung/' . $data_gedung['foto']);
        move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/gedung/' . $_FILES['foto']['name']);
        $foto = $_FILES['foto']['name'];
    }

    $edit_gedung = mysqli_query($koneksi, "UPDATE gedung SET nama_gedung = '$nama_gedung', nama_pic = '$nama_pic', nohp_pic = '$nohp_pic', alamat_pic = '$alamat_pic', luas_tanah = '$luas_tanah', tahun_berdiri = '$tahun_berdiri', alamat = '$alamat', foto = '$foto' WHERE id = '$id_gedung'");
    if( $edit_gedung ) {
        echo "<script>
            alert('Data gedung berhasil diperbarui');
            location.href = location.href;
        </script>";

    } else {
        echo "<script>alert('Data gedung gagal diperbarui!!');</script>";
    }
}

$isActive = 'masterdata-gedung';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-6">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Edit Data Gedung</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-gedung/data-gedung.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id">ID</label>
                        <input type="text" id="id" class="form-control" value="<?= $id_gedung ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Gedung</label>
                        <input type="text" id="nama" name="nama" class="form-control" value="<?= $data_gedung['nama_gedung'] ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="nama-pic">Nama Penanggung Jawab</label>
                        <input type="text" id="nama-pic" name="nama-pic" class="form-control" value="<?= $data_gedung['nama_pic'] ?>" placeholder="Nama Penanggung Jawab" required>
                    </div>

                    <div class="form-group">
                        <label for="nohp-pic">Nomor HP Penanggung Jawab</label>
                        <input type="number" id="nohp-pic" name="nohp-pic" class="form-control" value="<?= $data_gedung['nohp_pic'] ?>" placeholder="Nomor HP Penanggung Jawab" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat-pic">Alamat Penanggung Jawab</label>
                        <textarea id="alamat-pic" name="alamat-pic" rows="5" class="form-control" placeholder="Nama Penanggung Jawab" required><?= $data_gedung['alamat_pic'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="luas-tanah">Luas Tanah</label>
                        <input type="text" id="luas-tanah" name="luas-tanah" class="form-control" value="<?= $data_gedung['luas_tanah'] ?>" placeholder="Luas Tanah" required>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun Berdiri</label>
                        <input type="number" id="tahun" name="tahun" class="form-control" value="<?= $data_gedung['tahun_berdiri'] ?>" placeholder="Tahun Berdiri" required>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="5" placeholder="Alamat Gedung" required><?= $data_gedung['alamat'] ?></textarea>
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