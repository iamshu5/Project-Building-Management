<?php
require '../config.php';

if( !isset($_SESSION['login']) ) {
  header('Location: ../logout.php');
  die;
}

$id_maintenance = $_GET['id'];
if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  $lokasi = trim($_POST['lokasi']);
  $permasalahan = trim($_POST['permasalahan']);
  $deskripsi = trim($_POST['deskripsi']);
  $solusi = trim($_POST['solusi']);
  $estimasi = trim($_POST['estimasi']);

  if( !isset($_FILES['foto']) ) {
    echo "<script>alert('Foto laporan wajib diisi!!');</script>";
  } else {
    $foto = [];

    // upload file
    foreach( $_FILES['foto']['name'] as $index_file => $file_foto ) {
      move_uploaded_file($_FILES['foto']['tmp_name'][ $index_file ], '../assets/img/laporan/' . $file_foto);
      $foto[] = $file_foto;
    }

    $foto = json_encode($foto);
    $tanggal = date('Y-m-d');
    $tambah_laporan = mysqli_query($koneksi, "INSERT INTO laporan VALUES(NULL, '$id_maintenance', '$foto', '$lokasi', '$permasalahan', '$deskripsi', '$solusi', '$tanggal', '$estimasi')");
    if( $tambah_laporan ) {
      echo "<script>alert('Laporan berhasil disubmit!!');</script>";
    } else {
      echo "<script>alert('Gagal menambahkan laporan, error oi!!');</script>";
    }
  }
}

include 'template/header.php';
?>

<!-- Form Laporan -->
<section class="riwayat mt-4">
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
              <form action="" method="post" enctype="multipart/form-data">
                <ul type="none">
                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="Lokasi">Lokasi*</label>
                      <input type="text" class="form-control" name="lokasi" id="Lokasi" />
                    </li>
                  </div>

                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="lokasi">Permasalahan*</label>
                      <input type="text" class="form-control" name="permasalahan" id="lokasi" />
                    </li>
                  </div>

                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="Keterangan">Deskripsi Masalah*</label>
                      <textarea name="deskripsi" id="keterengan" class="form-control"></textarea>
                    </li>
                  </div>

                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="Keterangan">Solusi Masalah*</label>
                      <textarea name="solusi" class="form-control" id="keterengan"></textarea>
                    </li>
                  </div>

                  <div class="mb-3 col-md-11">
                    <li>
                      <label for="Keterangan">Estimasi Waktu Pengerjaan*</label>
                      <input type="text" class="form-control" name="estimasi" />
                    </li>
                  </div>

                  <div class="mb-3" id="foto-laporan">
                    <div class="mb-3 col-md-11" id="input-foto-1">
                      <li>
                        <label for="alamat">
                          Tambahkan Foto* 
                          <span class="badge badge-pills bg-danger text-white ml-2" onclick="hapusInputFoto('1');" style="cursor: pointer;">Hapus</span>
                        </label>
                        <br />
                        <input type="file" class="form" name="foto[]" id="foto" />
                      </li>
                    </div>
                  </div>

                  <div class="mb-3 col-md-11">
                    <button type="button" onclick="tambahInputFoto();" class="btn btn-info btn-sm">Tambah Foto</button>
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

            <!-- Riwayat Laporan -->
            <div class="card mt-5 mb-5">
              <div class="card-header shadow">
                <h5 class="text-gray-900 font-weight-bold">Riwayat Pelaporan</h5>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="table-laporan" class="table table-bordered text-center">
                    <thead class="text-gray-900 font-weight-bold">
                      <tr>
                        <th>NO</th>
                        <th>Lokasi</th>
                        <th>Permasalahan</th>
                        <th>Estimasi Waktu</th>
                        <th>Waktu</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $cek_riwayat_laporan = mysqli_query($koneksi, "SELECT * FROM laporan WHERE id_maintenance = '$id_maintenance'");
                      while( $data_riwayat_laporan = mysqli_fetch_assoc($cek_riwayat_laporan) ) {
                      ?>
                      <tr>
                        <td><?= $data_riwayat_laporan['id'] ?></td>
                        <td><?= $data_riwayat_laporan['lokasi'] ?></td>
                        <td><?= $data_riwayat_laporan['judul_masalah'] ?></td>
                        <td><?= $data_riwayat_laporan['estimasi'] ?></td>
                        <td><?= $data_riwayat_laporan['waktu'] ?></td>
                        <td>
                          <a class="btn btn-primary btn-sm" href="<?= URL_WEB ?>teknisi/ubah-laporan.php?id=<?= $data_riwayat_laporan['id'] ?>"> Ubah </a>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php include 'template/footer.php'; ?>

<script>
  let id_input_foto = 2;
  function tambahInputFoto() {
    $('#foto-laporan').append(`
      <div class="mb-3 col-md-11" id="input-foto-${ id_input_foto }">
        <li>
          <label for="alamat">
            Tambahkan Foto*
            <span class="badge badge-pills bg-danger text-white ml-2" onclick="hapusInputFoto('${ id_input_foto }');" style="cursor: pointer;">Hapus</span>
          </label>
          <br />
          <input type="file" class="form" name="foto[]" id="foto" />
        </li>
      </div>
    `);

    id_input_foto++;
  }

  function hapusInputFoto(id_input) {
    $(`#input-foto-${ id_input }`).remove();
  }

  $( function() {
    $('#table-laporan').DataTable();
  });
</script>