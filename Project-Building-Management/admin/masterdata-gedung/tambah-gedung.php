<?php
require '../../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../../logout.php');
    die;
}

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $nama_gedung = trim($_POST['nama']);
    $nama_pic = trim($_POST['nama-pic']);
    $nohp_pic = trim($_POST['nohp-pic']);
    $alamat_pic = trim($_POST['alamat-pic']);
    $luas_tanah = trim($_POST['luas-tanah']);
    $tahun_berdiri = trim($_POST['tahun']);
    $alamat = trim($_POST['alamat']);

    if( empty($_FILES['foto']['name']) ) {
        echo "<script>alert('Harap upload foto gedung!!');</script>";
    } else {
        move_uploaded_file($_FILES['foto']['tmp_name'], '../../assets/img/gedung/' . $_FILES['foto']['name']);
        $foto = $_FILES['foto']['name'];

        $tambah_gedung = mysqli_query($koneksi, "INSERT INTO gedung VALUES (NULL, '$nama_gedung', '$nama_pic', '$nohp_pic', '$alamat_pic', '$luas_tanah', '$tahun_berdiri', '$alamat', '$foto')");
        if($tambah_gedung) {
            header('Location: data-gedung.php');
            die;

        } else {
            echo "<script>alert('Data gedung gagal ditambahkan!!');</script>";
        }
    }
}

$isActive = 'masterdata-gedung';
include '../partials/header.php';
?>

<div class="row justify-content-center">
    <div class="col-sm-10 col-md-6">
        <div class="card shadow-lg">
            <div class="card-header bg-secondary d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0 text-white">Tambah Data Gedung</h5>
                <a href="<?= URL_WEB ?>admin/masterdata-gedung/data-gedung.php" class="btn btn-danger btn-sm shadow">Kembali</a>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nama">Nama Gedung</label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Gedung" required>
                    </div>

                    <div class="form-group">
                        <label for="nama-pic">Nama Penanggung Jawab</label>
                        <input type="text" id="nama-pic" name="nama-pic" class="form-control" placeholder="Nama Penanggung Jawab" required>
                    </div>

                    <div class="form-group">
                        <label for="nohp-pic">Nomor HP Penanggung Jawab</label>
                        <input type="number" id="nohp-pic" name="nohp-pic" class="form-control" placeholder="Nomor HP Penanggung Jawab" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat-pic">Alamat Penanggung Jawab</label>
                        <textarea id="alamat-pic" name="alamat-pic" rows="5" class="form-control" placeholder="Nama Penanggung Jawab" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="luas-tanah">Luas Tanah</label>
                        <input type="text" id="luas-tanah" name="luas-tanah" class="form-control" placeholder="Luas Tanah" required>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun Berdiri</label>
                        <input type="number" id="tahun" name="tahun" class="form-control" placeholder="Tahun Berdiri" required>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" id="foto" name="foto" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="5" placeholder="Alamat Gedung" required></textarea>
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