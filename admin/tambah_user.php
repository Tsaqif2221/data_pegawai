<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if (!isset($_SESSION['level'])) {
  header('location: ../index.php');
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Register login</title>
</head>

<body>
  <nav class="navbar navbar-dark bg-dark">
    <i class="navbar-brand">
      <i class="material-icons" style="font-size:20px;">add</i>
      Register login
    </i>
    <span class="align-text-bottom"><a style="color: white;">| </a><a class='btn btn-outline-light'
        href="data_user.php">Data User</a><a style="color: white;"> |</a></span>
  </nav>

  <div style="max-width: max-content;margin: auto;">
    <form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post" autocomplete="off">
      <div class="col-12" style="margin-top: 70px;">
        <div class="input-group">
          <div class="input-group-text"><i class="material-icons" style='color: black;'>person</i></div>
          <input type="text" class="form-control" name="username" placeholder="username" required>
        </div>
      </div>


      <div class="col-12" style="margin-top: 20px;">
        <div class="input-group">
          <div class="input-group-text"><i class="material-icons" style='color: black;'>lock</i></div>
          <input type="text" class="form-control" name="password" placeholder="password" required>
        </div>
      </div>


      <div class="col-12" style="margin-top: 20px;">
        <div class="input-group">
          <div class="input-group-text"><i class="material-icons" style='color: black;'>manage_accounts</i></div>
          <select class="form-control" name="level" required>
            <option disabled selected value>pilih level</option>
            <option>admin</option>
            <option>user</option>
          </select>
        </div>
      </div>

      <div class="col-12" style="margin-top: 20px;">
        <a>| </a>
        <input type="submit" value="Tambah Data" name="tambah" class='btn btn-outline-dark'>
        <a> | </a>
        <input type="reset" value="Reset" class='btn btn-outline-danger'>
        <a> |</a>
      </div>
    </form>
  </div>
  <center>
    <?php
    include('../config.php');
    if (isset($_POST['tambah'])) {
      $_username = $_POST['username'];
      $_password = $_POST['password'];
      $_level = $_POST['level'];
      $cek = "SELECT * FROM user  WHERE username='$_username'";
      $hasil = mysqli_query($konek, $cek);
      $ada = mysqli_num_rows($hasil);
      if ($ada > 0) {
        echo "
                  <i class='material-icons' style='font-size:70px; color: red;'>dangerous</i>
                  <br>
                  data sudah ada, silahkan ganti data lain";
      } else {
        $sql = "INSERT INTO user VALUES('', '$_username', '$_password', '$_level')";
        $simpan = mysqli_query($konek, $sql);

        if ($simpan) {
          echo "
                    <i class='material-icons' style='font-size:70px; color: green;'>check</i>
                    <br>
                    tambah data berhasil
                    <div style='margin-top: 60px'>
                    <a>| </a><a class='btn btn-outline-dark' href='tampil_data.php'>Tampilkan data</a><a> |</a>
                    </div>
                    ";
        } else {
          echo "
                    <i class='material-icons' style='font-size:70px; color: red;'>dangerous</i>
                    <br>
                    tambah data tidak berhasil";
        }
      }
    }
    ?>
  </center>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

</body>

</html>