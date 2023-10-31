<?php
include('config.php');

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($konek, $_GET['search']);
    $no = 1;

    $tampil = "SELECT * FROM pegawai WHERE nama LIKE '%$search%' OR jabatan LIKE '%$search%' OR alamat LIKE '%$search%'";
    $hasil = mysqli_query($konek, $tampil);

    echo '<table class="table">';
    echo '<thead class="thead-dark">';
    echo '<tr>';
    echo '<th scope="col">No</th>';
    echo '<th scope="col">Nama</th>';
    echo '<th scope="col">Jabatan</th>';
    echo '<th scope="col">Alamat</th>';
    echo '| <a class="btn btn-outline-light" href="tambah_data.php">Tambah Data</a> |';
    echo '</tr>';
    echo '</thead>';

    while ($data = mysqli_fetch_array($hasil)) {
        $id = $data['id'];
        $nama = $data['nama'];
        $jabatan = $data['jabatan'];
        $alamat = $data['alamat'];

        echo "<tr><th scope='Row'>$id.</th><th>$nama</th><th>$jabatan</th><th>$alamat</th><th><a class='btn btn-outline-dark' href='edit_pegawai.php?id=$id'>Edit</a> | <a class='btn btn-outline-danger' href='hapus_pegawai.php?id=$id'>Hapus</a></th></tr>";
        $no++;
    }

    echo '</table>';
}
?>
