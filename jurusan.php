<?php
session_start();

if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
          </script>";
    exit;
}

include 'layout/header.php'; // pastikan tidak ada output sebelum <?php di dalam file ini

$query = mysqli_query($db, "SELECT * FROM jurusan ORDER BY id_jurusan DESC");
if (!$query) {
    die("Query Error: " . mysqli_error($db));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Jurusan</title>
</head>
<body>
<div class="container mt-4">
    <h3>Manajemen Jurusan</h3>
    
    <!-- Tombol Tambah -->
    <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#modalJurusan" onclick="setForm('tambah')">
        + Tambah Jurusan
    </button>

    <!-- Tabel Jurusan -->
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Jurusan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) :
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_jurusan']) ?></td>
                <td>
                    <button 
                        class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#modalJurusan"
                        onclick="setForm('edit', <?= $row['id_jurusan'] ?>, '<?= addslashes($row['nama_jurusan']) ?>')"
                    >Edit</button>

                    <a href="proses_jurusan.php?hapus=<?= $row['id_jurusan'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus jurusan ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah/Edit -->
<div class="modal fade" id="modalJurusan" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="proses_jurusan.php">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Tambah Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_jurusan" id="id_jurusan">
                <div class="mb-3">
                    <label for="nama_jurusan" class="form-label">Nama Jurusan</label>
                    <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function setForm(mode, id = '', nama = '') {
    const modalTitle = document.getElementById('modalLabel');
    const inputId = document.getElementById('id_jurusan');
    const inputNama = document.getElementById('nama_jurusan');

    if (mode === 'edit') {
        modalTitle.innerText = 'Edit Jurusan';
        inputId.value = id;
        inputNama.value = nama;
    } else {
        modalTitle.innerText = 'Tambah Jurusan';
        inputId.value = '';
        inputNama.value = '';
    }
}
</script>
</body>
</html>
