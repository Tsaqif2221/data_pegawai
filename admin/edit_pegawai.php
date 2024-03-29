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
  <title>Edit Data</title>
</head>

<body>

  <nav class="navbar navbar-dark bg-dark">
    <i class="navbar-brand">
      <i class="material-icons" style="font-size:20px;">edit</i>
      Edit Data
    </i>
    <span class="align-text-bottom"><a style="color: white;">| </a><a class='btn btn-outline-light'
        href="tampil_data.php">Data pegawai</a><a style="color: white;"> |</a></span>
  </nav>

  <div style="max-width: max-content;margin: auto;">
    <?php
    include('../config.php');
    $id = $_GET['id'];
    $cari = "SELECT * FROM pegawai WHERE id=$id";
    $hasil = mysqli_query($konek, $cari);

    $data = mysqli_fetch_array($hasil);

    $id = $data['id'];
    $_nama = $data['nama'];
    $_jabatan = $data['jabatan'];
    $_alamat = $data['alamat'];
    $foto = $data['foto'];
    ?>
    <form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post" autocomplete="off"
      enctype="multipart/form-data">
      <input type="hidden" value="<?php echo $id; ?>" name="id">
      <div class="col-12" style="margin-top: 70px;">
        <div class="input-group">
          <div class="input-group-text"><i class="material-icons" style='color: black;'>person</i></div>
          <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $_nama; ?>" required>
        </div>
      </div>

      <div class="col-12" style="margin-top: 20px;">
        <div class="input-group">
          <div class="input-group-text"><i class="material-icons" style='color: black;'>engineering</i></div>
          <select class="form-control" name="jabatan" required>
            <option disabled selected value>jabatan</option>
            <option value="CEO" <?php if ($_jabatan === 'CEO')
              echo 'selected'; ?>>CEO</option>
            <option value="Manajer" <?php if ($_jabatan === 'Manajer')
              echo 'selected'; ?>>Manajer</option>
            <option value="Engineering" <?php if ($_jabatan === 'Engineering')
              echo 'selected'; ?>>Engineering</option>
            <option value="Staff" <?php if ($_jabatan === 'Staff')
              echo 'selected'; ?>>Staff</option>
          </select>
        </div>
      </div>


      <div class="col-12" style="margin-top: 20px;">
        <div class="input-group">
          <div class="input-group-text"><i class="material-icons" style='color: black;'>domain</i></div>
          <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="<?php echo $_alamat; ?>"
            required>
        </div>
      </div>

      <div class="col-12" style="margin-top: 20px;">
        <div class="input-group">
          <div class="input-group-text"><i class="material-icons" style='color: black;'>attach_file</i></div>
          <input type="file" class="form-control" name="foto" size="20">
        </div>
      </div>

      <div class="col-12" style="margin-top: 20px;">
        <a>| </a>
        <input type="submit" value="Update Data" name="update" class='btn btn-outline-dark'>
        <a> | </a>
        <input type="reset" value="Reset" class='btn btn-outline-danger'>
        <a> |</a>
      </div>
    </form>
  </div>
  <center>
    <img src="../foto/<?php echo $foto; ?>" weight="200px" height="200px">
    <br>
    <?php
    include('../config.php');
    include('fungsi_thumb.php');

    if (isset($_POST['update'])) {
      $id = $_POST['id'];
      $_nama = $_POST['nama'];
      $_jabatan = $_POST['jabatan'];
      $_alamat = $_POST['alamat'];

      $cari_foto = "SELECT foto FROM pegawai WHERE id=$id";
      $hasil_foto = mysqli_query($konek, $cari_foto);
      $data_foto = mysqli_fetch_array($hasil_foto);
      $foto_lama = $data_foto['foto'];

      if ($_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $lokasi_file = $_FILES['foto']['tmp_name'];
        $nama_file = $_FILES['foto']['name'];

        $acak = rand(000000, 999999);
        $nama_file_ok = $acak . '_' . time() . '_' . $nama_file;

        $folder = "../foto/";

        if (move_uploaded_file($lokasi_file, $folder . $nama_file_ok)) {

          if (!empty($foto_lama)) {
            unlink($folder . $foto_lama);
          }

          $sql = "UPDATE pegawai SET nama='$_nama', jabatan='$_jabatan', alamat='$_alamat', foto='$nama_file_ok' WHERE id=$id";
          $update = mysqli_query($konek, $sql);

          if ($update) {
            echo "
                    <i class='material-icons' style='font-size:70px; color: green;'>check</i>
                    <br>
                    Edit data berhasil
                    <div style='margin-top: 60px'>
                        <a>| </a><a class='btn btn-outline-dark' href='tampil_data.php'>Tampilkan data</a><a> |</a>
                    </div>";
          } else {
            echo "
                    <i class='material-icons' style='font-size:70px; color: red;'>dangerous</i>
                    <br>
                    Update data tidak berhasil";
          }
        } else {
          echo "Unggah file gagal.";
        }
      } else {

        $sql = "UPDATE pegawai SET nama='$_nama', jabatan='$_jabatan', alamat='$_alamat' WHERE id=$id";
        $update = mysqli_query($konek, $sql);

        if ($update) {
          echo "
                <i class='material-icons' style='font-size:70px; color: green;'>check</i>
                <br>
                Edit data berhasil
                <div style='margin-top: 60px'>
                    <a>| </a><a class='btn btn-outline-dark' href='tampil_data.php'>Tampilkan data</a><a> |</a>
                </div>";
        } else {
          echo "
                <i class='material-icons' style='font-size:70px; color: red;'>dangerous</i>
                <br>
                Update data tidak berhasil";
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