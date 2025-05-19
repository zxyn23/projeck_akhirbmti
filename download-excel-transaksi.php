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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

// Header kolom
$headers = ['No', 'Nama Produk', 'Kategori', 'Harga', 'Stok', 'Deskripsi', 'Created At'];
$columnLetters = range('A', 'G');

foreach ($headers as $index => $header) {
    $cell = $columnLetters[$index] . '2';
    $activeWorksheet->setCellValue($cell, $header);
    $activeWorksheet->getColumnDimension($columnLetters[$index])->setAutoSize(true);
}

// Ambil data transaksi dari database
$data_transaksi = select("SELECT * FROM transaksi");

$no = 1;
$row = 3; // Mulai dari baris ketiga karena baris kedua untuk header

foreach ($data_transaksi as $transaksi) {
    $activeWorksheet->setCellValue('A' . $row, $no++);
    $activeWorksheet->setCellValue('B' . $row, $transaksi['nama_produk']);
    $activeWorksheet->setCellValue('C' . $row, $transaksi['kategori']);
    $activeWorksheet->setCellValue('D' . $row, "Rp " . number_format($transaksi['harga'], 2, ',', '.'));
    $activeWorksheet->setCellValue('E' . $row, $transaksi['stok']);
    
    // Perbaikan penulisan field 'deskripsi' yang sebelumnya salah ('deksripsi')
    $activeWorksheet->setCellValue('F' . $row, $transaksi['deskripsi']);

    // Format tanggal
    $createdAt = date("d/m/Y H:i:s", strtotime($transaksi['created_at']));
    $activeWorksheet->setCellValue('G' . $row, $createdAt);

    $row++;
}

// Styling border
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$activeWorksheet->getStyle('A2:G' . ($row - 1))->applyFromArray($styleArray);

// Nama file untuk download
$filename = 'Laporan_Data_Transaksi.xlsx';

// Output file ke browser untuk diunduh tanpa menyimpan file di server
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;