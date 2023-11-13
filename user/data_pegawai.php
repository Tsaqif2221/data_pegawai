<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
if (!isset($_SESSION['level'])) {
    header('location: ../index.php');
    exit;
}
?>

<?php
include('../config.php');

$no = 1;

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($konek, $_GET['search']);

    $tampil = "SELECT * FROM pegawai WHERE nama LIKE '%$search%' OR jabatan LIKE '%$search%' OR alamat LIKE '%$search%'";
} else {
    $tampil = "SELECT * FROM pegawai";
}

$hasil = mysqli_query($konek, $tampil);
?>

<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Data Pegawai</title>
</head>

<body>
    <div class="pos-f-t">
        <div class="collapse" id="navbarToggleExternalContent">
            <div class="bg-dark p-4">
                <div style="margin-bottom: 10; color: red">
                   | <a href="../logout.php" class='btn btn-outline-danger'><i>logout</i></a> |
                </div>
            </div>
        </div>
        <nav class="navbar navbar-dark bg-dark">
            <i class="navbar-brand"><button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                Data Pegawai
            </i>
            <form class="form-inline" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="cari nama..." aria-label="Search"
                    name="search">
                <button class="btn btn-outline-light" type="submit"><i>Cari</i></button>
            </form>
        </nav>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Alamat</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <?php
        while ($data = mysqli_fetch_array($hasil)) {
            $id = $data['id'];
            $nama = $data['nama'];
            $jabatan = $data['jabatan'];
            $alamat = $data['alamat'];

            echo "<tr><th scope='Row'>$id.</th><th>$nama</th><th>$jabatan</th><th>$alamat</th></tr>";
            $no++;
        }
        ?>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

</body>

</html>