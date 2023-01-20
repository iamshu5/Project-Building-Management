<?php
require '../config.php';

if( !isset($_SESSION['login']) ) {
    header('Location: ../logout.php');
    die;
}

$id_teknisi = $_SESSION['login']['id'];
$cek_teknisi = mysqli_query($koneksi, "SELECT * FROM teknisi WHERE id = '$id_teknisi'");
$data_teknisi = mysqli_fetch_assoc($cek_teknisi);

include 'template/header.php';
?>

    <!--Profile  -->
    <section class="profile mt-4">
      <div class="container ms-auto">
        <div class="row justify-content-center">
          <div class="col-md-3">
            <div class="card shadow">
              <div class="card-body">
                <div class="text-center"><img src="<?= URL_WEB ?>assets/img/avatar.jpg" width="100px" alt="" /></div>
                <div class="card-title text-center"><?= $data_teknisi['nama_teknisi'] ?></div>
                <div class="card-text text-center text-gray-900">
                  <p>Teknisi (<?= $data_teknisi['nama_bagian'] ?>)</p>

                  <a href="<?= URL_WEB ?>logout.php" class="btn btn-danger mt-2 w-100">Logout</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--Profile gedung-->
    <section class="DataGedung mt-5">
      <div class="container">
        <div class="row">
            <?php
            $cek_kerjaan = mysqli_query($koneksi, "SELECT maintenance.id, gedung.nama_gedung, gedung.foto FROM maintenance JOIN gedung ON gedung.id = maintenance.id_gedung WHERE id_teknisi = '$id_teknisi'");
            while( $data_kerjaan = mysqli_fetch_assoc($cek_kerjaan) ) {
            ?>
          <div class="col-md-4">
            <a href="<?= URL_WEB ?>teknisi/data-gedung.php?id=<?= $data_kerjaan['id'] ?>">
              <div class="card mb-5 shadow">
                <div class="text-center"><img src="<?= URL_WEB ?>assets/img/gedung/<?= $data_kerjaan['foto'] ?>" class="card-img-top" alt="" width="350px" /></div>
                <div class="card-body pt-2">
                  <div class="card-title text-center">
                    <h3 class="pt-2 text-gray-900"><?= $data_kerjaan['nama_gedung'] ?></h3>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php } ?>
      </div>
    </section>
    <!-- end data gedung-->

<?php include 'template/footer.php'; ?>