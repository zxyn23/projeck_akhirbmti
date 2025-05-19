<?php
session_start();

if (!isset($_SESSION["login"])) {
  echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
  exit;
}

if ($_SESSION["level"] != 1 and $_SESSION["level"] != 2) {
  echo "<script>
            alert('Perhatian Anda Tidak Punya Hak Akses!!');
            document.location.href='akun.php';
        </script>";
  exit;
}

$title = 'Daftar Anggota';
include 'layout/header.php';

$jumlahDataPerhalaman = 5;
$halamanAktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;
$jumlahData = count(select("SELECT * FROM anggota"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$data_anggota = select("SELECT * FROM anggota ORDER BY id_anggota DESC LIMIT $awalData, $jumlahDataPerhalaman");
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2"></div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6"></div>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card shadow-sm rounded">
                  <div class="card-header bg-primary text-white">
                    <h3 class="card-title"><i class="nav-icon fas fa-users"></i> Data Anggota</h3>
                  </div>
                  <div class="card-body">
                  <div class="card-body">
                <a href="tambah-anggota.php" class="btn btn-primary mb-1"><i class="fas fa-plus"></i> Tambah </a>
                <a href="download-excel-anggota.php" class="btn btn-success mb-1">Download Excel</a>
                <a href="download-pdf-anggota.php" class="btn btn-danger mb-1">Download Pdf</a>
              </div>

                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-hover">
                        <thead class="thead-light">
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = $awalData + 1; ?>
                          <?php foreach ($data_anggota as $anggota): ?>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= htmlspecialchars($anggota['nama']); ?></td>
                              <td><?= htmlspecialchars($anggota['email']); ?></td>
                              <td><?= htmlspecialchars($anggota['alamat']); ?></td>
                              <td><?= htmlspecialchars($anggota['no_hp']); ?></td>
                              <td><?= date("d/m/Y", strtotime($anggota['tanggal_daftar'])); ?></td>
                              <td class="text-center">
                                <a href="ubah-anggota.php?id_anggota=<?= $anggota['id_anggota']; ?>" class="btn btn-warning rounded-pill" data-toggle="tooltip" title="Ubah Data">
                                  Ubah
                                </a>
                                <a href="hapus-anggota.php?id_anggota=<?= $anggota['id_anggota']; ?>" class="btn btn-danger rounded-pill" onclick="return confirm('Yakin Data Anggota Akan Dihapus?');" data-toggle="tooltip" title="Hapus Data">
                                  Hapus
                                </a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>

                    <nav aria-label="Page navigation" class="mt-4">
                      <ul class="pagination justify-content-center">
                        <?php if ($halamanAktif > 1) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                            </a>
                          </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                          <li class="page-item <?= $i == $halamanAktif ? 'active' : ''; ?>">
                            <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                          </li>
                        <?php endfor; ?>
                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                          <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                            </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </nav>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php include 'layout/footer.php' ?>
