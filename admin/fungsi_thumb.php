<?php
function thumb($upload_name, $direktori)
{

    $file_upload = $direktori . $upload_name;

    $nama_gbr_asli = $_FILES['foto']['tmp_name'];
    move_uploaded_file($nama_gbr_asli, $file_upload);
}
?>