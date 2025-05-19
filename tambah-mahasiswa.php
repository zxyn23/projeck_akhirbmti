<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

$title = 'Tambah Mahasiswa';
include 'layout/header.php';

if (isset($_POST['tambah'])) {
    if (create_mahasiswa($_POST) > 0) {
        echo "<script>
            alert('Data Mahasiswa Berhasil Ditambahkan');
            document.location.href = 'mahasiswa.php';
        </script>";
    } else {
        echo "<script>
            alert('Data Mahasiswa Gagal Ditambahkan');
            document.location.href = 'mahasiswa.php';
        </script>";
    }
}
?>

<div class="content-wrapper">
    <div class="content mt-5">
        <h1>Tambah Data Mahasiswa</h1>
        <hr>
        <a href="mahasiswa.php" class="btn btn-primary mb-3 rounded-pill">
            <i class="fa-solid fa-right-from-bracket"></i> Kembali
        </a>

        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
    <label for="nim" class="form-label">NIM</label>
    <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM..." required>
</div>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Mahasiswa..." required>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="prodi" class="form-label">Jurusan</label>
                    <select name="prodi" id="prodi" class="form-control" required>
                        <option value="">--Pilih Jurusan--</option>
                        <option value="Teknik Komputer dan Informatika">Teknik Komputer dan Informatika</option>
                        <option value="Teknik Kimia">Teknik Kimia</option>
                        <option value="Teknik Mesin">Teknik Mesin</option>
                        <option value="Teknik Sipil">Teknik Sipil</option>
                        <option value="Teknik Elektro">Teknik Elektro</option>
                        <option value="Teknik Otomotif">Teknik Otomotif</option>
                        <option value="Rekam Medik">Rekam Medik</option>
                        <option value="Akuntansi">Akuntansi</option>
                    </select>
                </div>

                <div class="mb-3 col-6">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select name="jk" id="jk" class="form-control" required>
                        <option value="">--Pilih Jenis Kelamin--</option>
                        <option value="Laki Laki">Laki Laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>



            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat lengkap..."></textarea>
            </div>

            

            

            <button type="submit" name="tambah" class="btn btn-primary rounded-pill float-end">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>
