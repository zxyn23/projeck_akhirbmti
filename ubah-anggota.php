<?php
session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "<script>
        alert('login dulu');
        document.location.href = 'login.php';
        </script>";
    exit;
}

$title = 'Ubah anggota';

include 'layout/header.php';

// Mengecek jika tombol ubah ditekan
if (isset($_POST['ubah'])) {
    if (update_anggota($_POST, $_FILES) > 0) {
        echo "<script>
        alert('Data anggota Berhasil Diubah');
        document.location.href = 'anggota.php';
        </script>";
    } else {
        echo "<script>
            alert('Data anggota Gagal Diubah');
            document.location.href = 'anggota.php';
            </script>";
    }
}

// ambil id_anggota dari url
$id_anggota = (int)$_GET['id_anggota'];

// query ambil data anggota
$anggota = select("SELECT * FROM anggota WHERE id_anggota = $id_anggota")[0];

?>

<div class="content-wrapper">
    <div class="content mt-5">
        <h1>Ubah Data Anggota</h1>
        <hr>
        <a href="anggota.php" class="btn btn-primary mb-3 rounded-pill">
            <i class="fa-solid fa-right-from-bracket"></i> Kembali
        </a>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_anggota" value="<?= $anggota['id_anggota']; ?>">

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $anggota['nama']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $anggota['email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required><?= $anggota['alamat']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?= $anggota['no_hp']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" value="<?= $anggota['tanggal_daftar']; ?>" required>
            </div>

            <button type="submit" name="ubah" class="btn btn-success rounded-pill" style="float: right;">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
