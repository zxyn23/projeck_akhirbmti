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
if ($_SESSION["level"] != 1 && $_SESSION["level"] != 3) {
    echo "<script>
            alert('Anda Tidak Punya Hak Akses!!');
            document.location.href='transaksi.php';
          </script>";
    exit;
}

require 'config/app.php';
require 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

// Ambil data transaksi dari database
$data_transaksi = select("SELECT * FROM transaksi");

// Mulai pembuatan konten HTML untuk PDF
$content = '<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
</style>';

$content .= '<page>
    <h2>Laporan Data Transaksi</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>';

$no = 1;
foreach ($data_transaksi as $transaksi) {
    $hargaFormatted = 'Rp ' . number_format($transaksi['harga'], 2, ',', '.');
    $createdAtFormatted = date("d/m/Y H:i:s", strtotime($transaksi['created_at']));

    $content .= "
        <tr>
            <td>{$no}</td>
            <td>" . htmlspecialchars($transaksi['nama_produk']) . "</td>
            <td>" . htmlspecialchars($transaksi['kategori']) . "</td>
            <td>{$hargaFormatted}</td>
            <td>" . htmlspecialchars($transaksi['stok']) . "</td>
            <td>" . htmlspecialchars($transaksi['deskripsi']) . "</td>
            <td>{$createdAtFormatted}</td>
        </tr>";
    $no++;
}

$content .= '</tbody>
    </table>
</page>';

// Generate PDF
oB_start();
$html2pdf = new Html2Pdf('L', 'A4', 'en'); // Landscape, A4
$html2pdf->writeHTML($content);
$html2pdf->output('Laporan_Data_Transaksi.pdf');
exit;
