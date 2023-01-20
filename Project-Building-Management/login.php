<?php
require 'config.php';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  $login_sebagai = trim($_POST['login-sebagai']);

  $cek_user = $login_sebagai == 'Admin'
    ? mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username'")
    : mysqli_query($koneksi, "SELECT * FROM teknisi WHERE username = '$username'");
  $data_user = mysqli_fetch_assoc($cek_user);

  if( mysqli_num_rows($cek_user) == 0 ) {
    echo "<script>alert('Username tidak terdaftar!!');</script>";
  } else if( !password_verify($password, $data_user['password']) ) {
    echo "<script>alert('Password anda salah!!');</script>";

  } else {
    $_SESSION['login'] = [
      'id' => $data_user['id'],
      'login_sebagai' => $login_sebagai
    ];

    header('Location: index.php');
    die;
  }
}

include 'teknisi/template/header.php';
?>

<div class="container">
      <!-- Outer Row -->
      <div class="row justify-content-center">
        <div class="col-md-6 col-md-6">
          <div class="shadow mt-5 ms-auto">
            <div class="card-body p-1">
              <!-- Nested Row within Card Body -->

              <div class="row justify-content-center">
                <div class="col-lg-10">
                  <div class="p-3">
                    <div class="text-center">
                      <h1 class="h4 font-weight-bold text-gray-900 mb-4">Login</h1>
                    </div>
                    <form class="user" method="post">
                      <div class="form-group">
                        <input type="text" class="form-control form-control-user font-weight-bold" name="username" placeholder="Username" required />
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user font-weight-bold mt-3" name="password" placeholder="Password" required />
                      </div>
                      <div class="form-group">
                        <select name="login-sebagai" class="form-control">
                          <option value="" selected disabled>Login Sebagai</option>
                          <option value="Teknisi">Teknisi</option>
                          <option value="Admin">Admin</option>
                        </select>
                      </div>
                      
                      <button type="submit" class="mt-4 btn btn-primary btn-user btn-block font-weight-bold shadow-sm mb-2"> Login </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php include 'teknisi/template/footer.php';