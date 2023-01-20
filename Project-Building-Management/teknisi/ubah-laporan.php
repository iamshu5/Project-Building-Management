<?php
require '../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../logout.php');
    die;
}

$id_laporan = $_GET['id'];
$cek_laporan = mysqli_query($koneksi, "SELECT * FROM laporan WHERE id = '$id_laporan'");
$data_laporan = mysqli_fetch_assoc($cek_laporan);
$data_laporan['foto'] = json_decode($data_laporan['foto'], true);

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $lokasi = $_POST['lokasi'];
    $permasalahan = $_POST['permasalahan'];
    $deskripsi = $_POST['deskripsi'];
    $solusi = $_POST['solusi'];
    $estimasi = $_POST['estimasi'];

    $edit = mysqli_query($koneksi, "UPDATE laporan SET lokasi = '$lokasi', judul_masalah = '$permasalahan', deskripsi_masalah = '$deskripsi', solusi_masalah = '$solusi', estimasi = '$estimasi' WHERE id = '$id_laporan'");
    if($edit) {
        header('Location: data-gedung.php?id=' . $id_laporan);
    } else {
        echo "<script>alert('Data laporan gagal diubah, error oi!!');</script>";
    }
}

include 'template/header.php';
?>

<section class="riwayat my-5">
      <div class="container ms-auto">
        <div class="row justify-content-center">
          <div class="col-md-9">
            <div class="card-header d-flex justify-content-between">
              <div class="font-weight-bold text-center">
                <h4 class="text-gray-900">Form Laporan</h4>
              </div>
              <div class="font-weight-bold text-start ms-auto">
                <a href="<?= URL_WEB ?>teknisi/index.php" class="btn btn-primary btn-sm shadow">Kembali Beranda</a>
              </div>
            </div>

            <div class="card-body shadow text-gray-900 font-weight-bold bg-light">
              <form action="" method="post">
                <ul type="none">
                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="Lokasi">Lokasi*</label>
                      <input type="text" class="form-control" name="lokasi" id="Lokasi" value="<?= $data_laporan['lokasi'] ?>" required />
                    </li>
                  </div>

                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="lokasi">Permasalahan*</label>
                      <input type="text" class="form-control" name="permasalahan" id="lokasi" value="<?= $data_laporan['judul_masalah'] ?>" required />
                    </li>
                  </div>

                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="Keterangan">Deskripsi Masalah*</label>
                      <textarea name="deskripsi" id="keterengan" class="form-control" required><?= $data_laporan['deskripsi_masalah'] ?></textarea>
                    </li>
                  </div>

                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="Keterangan">Solusi Masalah*</label>
                      <textarea name="solusi" class="form-control" id="keterengan" required><?= $data_laporan['lokasi'] ?></textarea>
                    </li>
                  </div>

                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="Keterangan">Estimasi Waktu Pengerjaan*</label>
                      <input type="text" class="form-control" name="estimasi" value="<?= $data_laporan['estimasi'] ?>" required />
                    </li>
                  </div>

                  <div class="mb-3" id="foto-laporan">
                    <div class="mb-3 col-md-11" id="input-foto-1">
                      <li>
                        <label for="alamat">Foto Laporan</label>
                        <br />
                        
                        <?php foreach($data_laporan['foto'] as $foto_laporan) { ?>
                            <img height="180" class="mr-4" src="<?= URL_WEB ?>assets/img/laporan/<?= $foto_laporan ?>">
                        <?php } ?>

                      </li>
                    </div>
                  </div>

                  <div class="mt-2">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <li>
                        <button type="submit" class="form-control btn btn-primary shadow" name="submit">Kirim</button>
                      </li>
                    </div>
                  </div>
                </ul>
              </form>
            </div>
          </div>
</div>
      </div>
</section>

<?php include 'template/footer.php';