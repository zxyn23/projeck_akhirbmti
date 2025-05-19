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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

// Header kolom
$headers = ['No', 'Nama Anggota', 'Email', 'Alamat', 'No HP', 'Tanggal Daftar'];
$columnLetters = range('A', 'F');

foreach ($headers as $index => $header) {
    $cell = $columnLetters[$index] . '2';
    $activeWorksheet->setCellValue($cell, $header);
    $activeWorksheet->getColumnDimension($columnLetters[$index])->setAutoSize(true);
}

// Ambil data anggota dari database
$data_anggota = select("SELECT * FROM anggota");

$no = 1;
$row = 3; // Mulai dari baris ketiga karena baris kedua untuk header

foreach ($data_anggota as $anggota) {
    $activeWorksheet->setCellValue('A' . $row, $no++);
    $activeWorksheet->setCellValue('B' . $row, $anggota['nama']);
    $activeWorksheet->setCellValue('C' . $row, $anggota['email']);
    $activeWorksheet->setCellValue('D' . $row, $anggota['alamat']);
    $activeWorksheet->setCellValue('E' . $row, $anggota['no_hp']);
    $activeWorksheet->setCellValue('F' . $row, $anggota['tanggal_daftar']);
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
$activeWorksheet->getStyle('A2:F' . ($row - 1))->applyFromArray($styleArray);

// Nama file untuk download
$filename = 'Laporan Data Anggota.xlsx';

// Output file ke browser untuk diunduh tanpa menyimpan file di server
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;