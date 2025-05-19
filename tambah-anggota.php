<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

$title = 'Tambah Anggota';
include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (create_anggota($_POST) > 0) {
        echo "<script>
            alert('Data Anggota Berhasil Ditambahkan');
            document.location.href = 'anggota.php';
            </script>";
    } else {
        echo "<script>
        alert('Data Anggota Gagal Ditambahkan');
        document.location.href = 'anggota.php';
        </script>";
    }
}
?>

<div class="content-wrapper">
    <div class="content mt-5">
        <h1>Tambah Data Anggota</h1>
        <hr>
        <a href="anggota.php" class="btn btn-primary mb-3 rounded-pill">
            <i class="fa-solid fa-right-from-bracket"></i> Kembali
        </a>

        <form action="" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama anggota..." required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email..." required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="No HP..." required>
            </div>

            <div class="mb-3">
                <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" required>
            </div>

            <button type="submit" name="tambah" class="btn btn-primary rounded-pill" style="float: right;">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
