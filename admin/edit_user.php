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
            <i class="material-icons" style="font-size:20px;">edit</i>
            Edit Data User
        </i>
        <span class="align-text-bottom"><a style="color: white;">| </a><a class='btn btn-outline-light'
                href="tampil_data.php">Data pegawai</a><a style="color: white;"> |</a></span>
    </nav>

    <div style="max-width: max-content;margin: auto;">
        <?php
        include('../config.php');
        $id = $_GET['id_user'];
        $cari = "SELECT * FROM user WHERE id_user=$id";
        $hasil = mysqli_query($konek, $cari);

        $data = mysqli_fetch_array($hasil);

        $id = $data['id_user'];
        $_username = $data['username'];
        $_password = $data['password'];
        $_level = $data['level'];
        ?>
        <form class="row row-cols-lg-auto g-3 align-items-center" action="" method="post" autocomplete="off">
            <input type="hidden" value="<?php echo $id; ?>" name="id_user">
            <div class="col-12" style="margin-top: 70px;">
                <div class="input-group">
                    <div class="input-group-text"><i class="material-icons" style='color: black;'>person</i></div>
                    <input type="text" class="form-control" name="username" placeholder="Username"
                        value="<?php echo $_username; ?>">
                </div>
            </div>

            <div class="col-12" style="margin-top: 20px;">
                <div class="input-group">
                    <div class="input-group-text"><i class="material-icons" style='color: black;'>lock</i></div>
                    <input type="text" class="form-control" name="password" placeholder="Password"
                        value="<?php echo $_password; ?>">
                </div>
            </div>


            <div class="col-12" style="margin-top: 20px;">
                <div class="input-group">
                    <div class="input-group-text"><i class="material-icons" style='color: black;'>engineering</i></div>
                    <select class="form-control" name="level" value="<?php echo $_password; ?>">
                        <option disabled selected value>pilih level</option>
                        <option>admin</option>
                        <option>user</option>
                    </select>
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
        <?php
        include('../config.php');
        if (isset($_POST['update'])) {
            $id = $_POST['id_user'];
            $_username = $_POST['username'];
            $_password = $_POST['password'];
            $_level = $_POST['level'];
            $sql = "UPDATE user SET username='$_username', password='$_password', level='$_level' WHERE id_user=$id";
            $update = mysqli_query($konek, $sql);

            if ($update) {
                echo "
                    <i class='material-icons' style='font-size:70px; color: green;'>check</i>
                    <br>
                    edit data user berhasil
                    <div style='margin-top: 60px'>
                    <a>| </a><a class='btn btn-outline-dark' href='data_user.php'>Tampilkan data user</a><a> |</a>
                    </div>";
            } else {
                echo "
                    <i class='material-icons' style='font-size:70px; color: red;'>dangerous</i>
                    <br>
                    tambah data user tidak berhasil";
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