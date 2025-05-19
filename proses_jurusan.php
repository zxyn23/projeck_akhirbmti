<?php
include 'config/app.php';

if (isset($_POST['simpan'])) {
    $id = $_POST['id_jurusan'];
    $nama = mysqli_real_escape_string($db, $_POST['nama_jurusan']);

    if ($id) {
        // Edit data
        $query = "UPDATE jurusan SET nama_jurusan = '$nama' WHERE id_jurusan = $id";
    } else {
        // Tambah data
        $query = "INSERT INTO jurusan (nama_jurusan) VALUES ('$nama')";
    }

    mysqli_query($db, $query);
    header("Location: jurusan.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($db, "DELETE FROM jurusan WHERE id_jurusan = $id");
    header("Location: jurusan.php");
    exit;
}
?>
