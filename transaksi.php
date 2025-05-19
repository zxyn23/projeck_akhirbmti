<?php
session_start();

// Cek login
if (!isset($_SESSION["login"])) {
  echo "<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
          </script>";
  exit;
}

// Cek level akses
if ($_SESSION["level"] != 1 && $_SESSION["level"] != 2) {
  echo "<script>
            alert('Perhatian! Anda Tidak Punya Hak Akses!');
            document.location.href='akun.php';
          </script>";
  exit;
}

$title = 'Daftar Transaksi';
include 'layout/header.php';

// Pagination setup
$jumlahDataPerhalaman = 5;
$halamanAktif = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

// Hitung total data transaksi
$jumlahData = count(select("SELECT * FROM transaksi"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

// Ambil data transaksi
$data_transaksi = select("SELECT * FROM transaksi ORDER BY id DESC LIMIT $awalData, $jumlahDataPerhalaman");
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <h1 class="mb-4">Data Transaksi</h1>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow-sm rounded">
            <div class="card-header bg-primary text-white">
              <h3 class="card-title"><i class="nav-icon fas fa-receipt"></i> Daftar Transaksi</h3>
            </div>

            <div class="card-body">
              <!-- /.card-header -->
              <div class="card-body">
                <a href="tambah-transaksi.php" class="btn btn-primary mb-1"><i class="fas fa-plus"></i> Tambah </a>
                <a href="download-excel-transaksi.php" class="btn btn-success mb-1">Download Excel</a>
                <a href="download-pdf-transaksi.php" class="btn btn-danger mb-1">Download Pdf</a>
              </div>


              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                  <thead class="thead-light">
                    <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Kategori</th>
                      <th>Harga</th>
                      <th>Stok</th>
                      <th>Deskripsi</th>
                      <th>Created at</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($data_transaksi)) : ?>
                      <tr>
                        <td colspan="8" class="text-center">Data transaksi belum ada.</td>
                      </tr>
                    <?php else : ?>
                      <?php $no = $awalData + 1; ?>
                      <?php foreach ($data_transaksi as $transaksi) : ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= htmlspecialchars($transaksi['nama_produk']); ?></td>
                          <td><?= htmlspecialchars($transaksi['kategori']); ?></td>
                          <td>Rp <?= number_format($transaksi['harga'], 2, ',', '.'); ?></td>
                          <td><?= htmlspecialchars($transaksi['stok']); ?></td>
                          <td><?= htmlspecialchars($transaksi['deskripsi']); ?></td>
                          <td><?= date("d/m/y | H:i:s", strtotime($transaksi['created_at'])); ?></td>
                          <td class="text-center">
                            <a href="ubah-transaksi.php?id=<?= $transaksi['id']; ?>" class="btn btn-warning rounded-pill" data-toggle="tooltip" title="Ubah">
                              Ubah
                            </a>
                            <a href="hapus-transaksi.php?id=<?= $transaksi['id']; ?>" class="btn btn-danger rounded-pill" onclick="return confirm('Yakin ingin menghapus transaksi ini?');" data-toggle="tooltip" title="Hapus">
                              Hapus
                            </a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
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
                    <li class="page-item <?= ($i === $halamanAktif) ? 'active' : ''; ?>">
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

<?php include 'layout/footer.php'; ?>