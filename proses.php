<?php
include("config.php");
session_start();

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $query = mysqli_query($konek, $sql)or die("SQL Erorr, $sql");

    $data=mysqli_num_rows($query);
    if($data> 0){
        $data = mysqli_fetch_array($query);
        $level = $data["level"];

        if ($level== 'admin') {
            $_SESSION['level'] = 'admin';
            header('location:tambah_data.php');
        }else {
            $_SESSION['level'] = 'user';
            header('location:tampil_data.php');
        }
}else{
    include('index.php');
}
}
?>

</php
