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
    <title>Edit Data User</title>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark">
        <i class="navbar-brand">
            <i class="material-icons" style="font-size:20px;">engineering</i>
            Detail data
        </i>
        <span class="align-text-bottom"><a style="color: white;">| </a><a class='btn btn-outline-light'
                href="tampil_data.php">Kembali</a><a style="color: white;"> |</a></span>
    </nav>

    <div>
        <?php
        include('../config.php');
        $id = $_GET['id'];
        $cari = "SELECT pegawai.id, pegawai.nama, pegawai.jabatan, pegawai.alamat, pegawai.id_user, pegawai.foto, user.username, user.level FROM pegawai JOIN user ON pegawai.id_user=user.id_user WHERE id=$id";
        $hasil = mysqli_query($konek, $cari);
        $ada = mysqli_num_rows($hasil);
        if ($ada > 0) {

            $data = mysqli_fetch_array($hasil);

            $id = $data['id'];
            $_nama = $data['nama'];
            $_jabatan = $data['jabatan'];
            $_alamat = $data['alamat'];
            $_id_user = $data['id_user'];
            $_username = $data['username'];
            $_level = $data['level'];
            $_foto = $data['foto'];
            ?>
            <table class="table">
                <thead>
                    <th>Id</th>
                    <th>:
                        <?php echo $id; ?>
                    </th>
                </thead>
                <thead>
                    <th>Nama</th>
                    <th>:
                        <?php echo $_nama; ?>
                    </th>
                </thead>
                <thead>
                    <th>Jabatan</th>
                    <th>:
                        <?php echo $_jabatan; ?>
                    </th>
                </thead>
                <thead>
                    <th>Alamat</th>
                    <th>:
                        <?php echo $_alamat; ?>
                    </th>
                </thead>
                <thead>
                    <th>Id user</th>
                    <th>:
                        <?php echo $_id_user; ?>
                    </th>
                </thead>
                <thead>
                    <th>Username</th>
                    <th>:
                        <?php echo $_username; ?>
                    </th>
                </thead>
                <thead>
                    <th>Level</th>
                    <th>:
                        <?php echo $_level; ?>
                    </th>
                </thead>
            </table>
            <center>
                <img src="../foto/<?php echo $_foto; ?>" weight="200px" height="200px">
            </center>
        </div>

        <?php
        } else {
            echo "
            <div style='max-width: max-content;margin: auto;'>
            <center>
            <i class='material-icons' style='font-size:70px; margin-top:70px; color: red;'>priority_high</i>
            <br>
            register data user
            <div style='margin-top: 40px'>
            <a>| </a><a class='btn btn-outline-dark' href='tambah_user.php'>Tambah user?</a><a> |</a>
            </div>
            </center>
            </div>";
        }
        ?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>

</body>

</html>