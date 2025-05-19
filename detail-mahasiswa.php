<?php

session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

$title = 'Detail Mahasiswa';

include 'layout/header.php';


// menagmbil id mahasiswa dari url
$id_mahasiswa = (int) $_GET['id_mahasiswa'];

// menampilkan data mahasiswa
$mahasiswa = mysqli_query($db, "SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa");
$mahasiswa = mysqli_fetch_array($mahasiswa);

?>

<div class="content-wrapper mt-5">
    <h1>Data <?= $mahasiswa['nama']; ?></h1>
    <hr>

    <table class="table table-bordered table-striped mt-3">

        <tr>
            <td>Nama</td>
            <td>: <?= $mahasiswa['nama']; ?></td>
        </tr>

        <tr>
            <td>prodi</td>
            <td>: <?= $mahasiswa['prodi']; ?></td>
        </tr>

        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= $mahasiswa['jk']; ?></td>
        </tr>

        
        <tr>
            <td>Alamat</td>
            <td>: <?= $mahasiswa['alamat']; ?></td>
        </tr>

        

    
    </table>
    <a href="mahasiswa.php" class="btn btn-secondary rounded-pill" style="float: right;">Kembali</a>
</div>

<?php include 'layout/footer.php'; ?>