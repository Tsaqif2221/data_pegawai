<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <title>Tambah Data</title>
</head>
<body style="margin-top: 100px;">
<center>
<?php
include('config.php');
$id = $_GET['id'];

            
$sql = "DELETE FROM pegawai WHERE id='$id'";
$hapus = mysqli_query($konek, $sql);
if ($hapus) {
    echo "
    <i class='material-icons' style='font-size:70px; color: green;'>check</i>
    <br>
    hapus data berhasil";
} else {
    echo "
    <i class='material-icons' style='font-size:70px; color: red;'>dangerous</i>
    <br>
    hapus data tidak berhasil";
}
?>
<br>
<div style="margin-top: 60px">
<a>| </a><a class='btn btn-outline-dark' href="tampil_data.php">Kembali</a><a> |</a>
</div>
</center>
</body>
</html>