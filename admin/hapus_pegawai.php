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
    <title>Tambah Data</title>
</head>

<body style="margin-top: 100px;">
    <center>
        <?php
        include('../config.php');

        $id = $_GET['id'];

        $sql_select = "SELECT foto FROM pegawai WHERE id='$id'";
        $result_select = mysqli_query($konek, $sql_select);

        if ($result_select) {
            $data_select = mysqli_fetch_assoc($result_select);
            $foto_to_delete = $data_select['foto'];

            $sql_delete = "DELETE FROM pegawai SET id = id - 1 WHERE id='$id'";
            $hapus = mysqli_query($konek, $sql_delete);

            if ($hapus) {

                if (!empty($foto_to_delete) && file_exists("../foto/" . $foto_to_delete)) {
                    unlink("../foto/" . $foto_to_delete);
                }

                echo "
            <i class='material-icons' style='font-size:70px; color: green;'>check</i>
            <br>
            Hapus data berhasil";
            } else {
                echo "
            <i class='material-icons' style='font-size:70px; color: red;'>dangerous</i>
            <br>
            Hapus data tidak berhasil";
            }
        } else {
            echo "Error dalam mengambil data foto sebelum dihapus.";
        }

        ?>
        <br>
        <div style="margin-top: 60px">
            <a>| </a><a class='btn btn-outline-dark' href="tampil_data.php">Kembali</a><a> |</a>
        </div>

    </center>
</body>

</html>