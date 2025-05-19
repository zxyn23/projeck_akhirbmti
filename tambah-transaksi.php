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
    if (create_transaksi($_POST) > 0) {
        echo "<script>
            alert('Data transaksi Berhasil Ditambahkan');
            document.location.href = 'transaksi.php';
            </script>";
    } else {
        echo "<script>
        alert('Data transaksi Gagal Ditambahkan');
        document.location.href = 'transaksi.php';
        </script>";
    }
}
?>
<div class="content-wrapper">
    <div class="content mt-5">
        <h1>Tambah Data Transaksi</h1>
        <hr>
        <a href="transaksi.php" class="btn btn-primary mb-3 rounded-pill">
            <i class="fa-solid fa-right-from-bracket"></i> Kembali
        </a>

        <form action="" method="post">
        <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Anggota..." required>
            </div>


            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori..." required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label"> Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" min="0" placeholder="Harga..." required>
            </div>

            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stok..." required>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi..." required>
            </div>


            <button type="submit" name="tambah" class="btn btn-primary rounded-pill" style="float: right;">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
