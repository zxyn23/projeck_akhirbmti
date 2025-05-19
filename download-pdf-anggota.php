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
            document.location.href='anggota.php';
          </script>";
    exit;
}

require 'config/app.php';
require 'vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

// Ambil data anggota dari database
$data_anggota = select("SELECT * FROM anggota");

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
    <h2>Laporan Data Anggota</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>';

$no = 1;
foreach ($data_anggota as $anggota) {

    $content .= "
        <tr>
            <td>{$no}</td>
            <td>" . htmlspecialchars($anggota['nama']) . "</td>
            <td>" . htmlspecialchars($anggota['email']) . "</td>
            <td>" . htmlspecialchars($anggota['alamat']) . "</td>
            <td>" . htmlspecialchars($anggota['no_hp']) . "</td>
            <td>" . htmlspecialchars($anggota['tanggal_daftar']) . "</td>

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
$html2pdf->output('Laporan Data Anggota.pdf');
exit;
