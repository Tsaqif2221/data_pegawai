<?php
include("config.php");
session_start();

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $query = mysqli_query($konek, $sql) or die("SQL Erorr, $sql");

  $data = mysqli_num_rows($query);
  if ($data > 0) {
    $data = mysqli_fetch_array($query);
    $level = $data["level"];

    if ($level == 'admin') {
      $_SESSION['level'] = 'admin';
      header('location: admin/tampil_data.php');
    } else {
      $_SESSION['level'] = 'user';
      header('location: user/data_pegawai.php');
    }
  } else {
    header('location: index.php');
  }
}
?>

<html>

<head>
  <title>Form Login</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
  <div class="pos-f-t">
    <div class="collapse" id="navbarToggleExternalContent">
      <div class="bg-dark p-4">
        <h4 class="text-white">Form Login</h4>
        <span class="text-muted"><a href="#">info detai?<a></span>
      </div>
    </div>
    <nav class="navbar navbar-dark bg-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent"
        aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>
  </div>
  <form method="post" autocomplete="off">
    <div style="max-width: max-content;margin: auto;">
      <form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post">
        <div class="col-12" style="margin-top: 100px;">
          <div class="input-group">
            <div class="input-group-text"><i class="material-icons" style='color: black;'>person</i></div>
            <input type="text" class="form-control" name="username" placeholder="Username" required>
          </div>
        </div>
        <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
          <div class="input-group">
            <div class="input-group-text"><i class="material-icons" style='color: black;'>lock</i></div>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
          </div>
        </div>
    </div>
    <center>
      | <button type="submit" name="login" class="btn btn-outline-dark"><i>Sign in</i></button> |
    </center>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

</body>

</html>