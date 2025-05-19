<?php
include 'config/app.php';

$id = (int)$_GET['id'];

session_start();


if (!isset($_SESSION["login"])) {
    echo"<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
  }

    if (delete_transaksi($id) > 0 )
    {
        echo"<script> 
        alert('Data anggota Berhasil DiHapus');
        document.location.href='transaksi.php';
        </script>";
    } else {
        echo"<script> 
        alert('Data anggota Gagal Diapus');
        document.location.href='transaksi.php';
        </script>";

    }


    

