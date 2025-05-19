<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}
if ($_SESSION["level"] != 1 && $_SESSION["level"] != 2 ) {
    echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses!!');
            document.location.href='akun.php';
        </script>";
    exit;
}

$title = 'Manajemen Jurusan';
include 'layout/header.php'; // Pastikan file ini tidak menghasilkan output sebelum header()

// Proses Tambah
if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama_jurusan']);
    $tambah = mysqli_query($db, "INSERT INTO jurusan (nama_jurusan) VALUES ('$nama')");
    if ($tambah) {
        header("Location: index.php");
        exit;  // Penting! Stop eksekusi agar redirect jalan
    } else {
        // Tampilkan error MySQL jika gagal (opsional)
        echo "<script>alert('Gagal menambahkan jurusan! Error: " . mysqli_error($db) . "');</script>";
    }
}

// Proses Hapus
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus']; // casting ke int untuk keamanan
    $hapus = mysqli_query($db, "DELETE FROM jurusan WHERE id_jurusan = $id");
    if ($hapus) {
        header("Location: index.php");
        exit;  // Stop eksekusi setelah redirect
    } else {
        echo "<script>alert('Gagal menghapus jurusan! Error: " . mysqli_error($db) . "');</script>";
    }
}

// Proses Edit
if (isset($_POST['edit'])) {
    $id = (int)$_POST['id_jurusan']; // casting ke int untuk keamanan
    $nama = htmlspecialchars($_POST['nama_jurusan']);
    $edit = mysqli_query($db, "UPDATE jurusan SET nama_jurusan='$nama' WHERE id_jurusan=$id");
    if ($edit) {
        header("Location: index.php");
        exit;  // Stop eksekusi setelah redirect
    } else {
        echo "<script>alert('Gagal mengedit jurusan! Error: " . mysqli_error($db) . "');</script>";
    }
}

// Ambil data jurusan
$data_jurusan = mysqli_query($db, "SELECT * FROM jurusan ORDER BY id_jurusan DESC");
?>

<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid mt-3">
      <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title"><i class="nav-icon fas"></i> Data Jurusan</h3>
        </div>
        <div class="card-body">
          <!-- Button -->
          <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambah">
            Tambah Jurusan
          </button>

          <!-- Tabel -->
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Jurusan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; while ($row = mysqli_fetch_assoc($data_jurusan)) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_jurusan']); ?></td>
                <td>
                  <!-- Tombol Edit -->
                  <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit<?= $row['id_jurusan']; ?>">Edit</button>
                  <!-- Tombol Hapus -->
                  <a href="?hapus=<?= $row['id_jurusan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data?')">Hapus</a>
                </td>
              </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="modalEdit<?= $row['id_jurusan']; ?>">
                <div class="modal-dialog">
                  <form method="POST">
                    <input type="hidden" name="id_jurusan" value="<?= $row['id_jurusan']; ?>">
                    <div class="modal-content">
                      <div class="modal-header bg-warning">
                        <h5 class="modal-title">Edit Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Nama Jurusan</label>
                          <input type="text" name="nama_jurusan" class="form-control" value="<?= htmlspecialchars($row['nama_jurusan']); ?>" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button name="edit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah">
  <div class="modal-dialog">
    <form method="POST">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title">Tambah Jurusan</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Jurusan</label>
            <input type="text" name="nama_jurusan" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button name="tambah" class="btn btn-primary">Tambah</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php include 'layout/footer.php'; ?>
