<?php
session_start();
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
}

if ($_SESSION["level"] != 1 and $_SESSION["level"] != 3 ) {
    echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses!!');
            document.location.href='akun.php';
        </script>";
    exit;
}

$title = 'Daftar mahasiswa';
include 'layout/header.php';

// Logika filter jurusan
if (isset($_POST['filter'])) {
    $prodi = $_POST['prodi'];
    $data_mahasiswa = select("SELECT * FROM mahasiswa WHERE prodi = '$prodi' ORDER BY id_mahasiswa DESC");
} else {
    $data_mahasiswa = select("SELECT * FROM mahasiswa ORDER BY id_mahasiswa DESC");
}
?>

<!-- Modal Filter Jurusan -->
<div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="modalFilterLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title" id="modalFilterLabel"><i class="fas fa-search"></i> Filter Data Jurusan</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="prodi">Pilih Jurusan</label>
            <select name="prodi" id="prodi" class="form-control" required>
              <option value="" disabled selected>-- Pilih Jurusan --</option>
              <option value="Teknik Informatika">Teknik Komputer dan Informatika</option>
              <option value="Sistem Informasi">Teknik Kimia</option>
              <option value="Manajemen Informatika">Teknik Mesin</option>
              <option value="Manajemen Informatika">Teknik Sipil</option>
              <option value="Manajemen Informatika">Teknik Elektro</option>
              <option value="Manajemen Informatika">Teknik Otomotif</option>
              <option value="Manajemen Informatika">Rekam Medik</option>
              <option value="Manajemen Informatika">Akuntansi</option>
              <!-- Tambah jurusan lain jika ada -->
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="filter" class="btn btn-primary">Tampilkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="content-wrapper">
  <!-- Content Header -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"><i class="nav-icon fas fa-user-graduate"></i> Data Mahasiswa</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Mahasiswa</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white">
              <h3 class="card-title">Tabel Data Mahasiswa</h3>
            </div>
            <div class="card-body">

              <!-- Tombol Aksi -->
              <div class="mb-3">
                <a href="tambah-mahasiswa.php" class="btn btn-primary rounded-pill mb-1">Tambah</a>
                <a href="download-excel-mahasiswa.php" class="btn btn-success rounded-pill mb-1">Download Excel</a>
                <a href="download-pdf-mahasiswa.php" class="btn btn-danger rounded-pill mb-1">Download PDF</a>
                <button type="button" class="btn btn-info rounded-pill mb-1" data-bs-toggle="modal" data-bs-target="#modalFilter">
                  Filter Jurusan
                </button>
              </div>

              <!-- Tabel Mahasiswa -->
              <div class="table-responsive">
                <table id="serverside" class="table table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th>No</th>
                    <th>Nim</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Tanggal</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
  <?php $no = 1; ?>
  <?php foreach ($data_mahasiswa as $mahasiswa): ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= htmlspecialchars($mahasiswa['nim']); ?></td>
      <td><?= htmlspecialchars($mahasiswa['nama']); ?></td>
      <td><?= htmlspecialchars($mahasiswa['jk']); ?></td>
      <td><?= htmlspecialchars($mahasiswa['prodi']); ?></td>
      <td><?= htmlspecialchars($mahasiswa['alamat']); ?></td>
      <td><?= date("d/m/Y | H:i:s", strtotime($mahasiswa['tanggal'])); ?></td>
      <td class="text-center">
        <a href="detail-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-secondary btn-sm rounded-pill" data-toggle="tooltip" title="Detail">
          <i class="fa-solid fa-circle-info"></i> Detail
        </a>
        <a href="ubah-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-warning btn-sm rounded-pill" data-toggle="tooltip" title="Ubah">
          <i class="fa-regular fa-pen-to-square"></i> Ubah
        </a>
        <a href="hapus-mahasiswa.php?id_mahasiswa=<?= $mahasiswa['id_mahasiswa']; ?>" class="btn btn-danger btn-sm rounded-pill" onclick="return confirm('Yakin hapus?');" data-toggle="tooltip" title="Hapus">
          <i class="fa-solid fa-trash-can"></i> Hapus
        </a>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'layout/footer.php'; ?>
