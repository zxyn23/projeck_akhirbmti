<?php
include 'config/app.php';

$id_anggota = (int)$_GET['id_anggota'];

session_start();


if (!isset($_SESSION["login"])) {
    echo"<script>
            alert('Login Dulu!!');
            document.location.href='login.php';
        </script>";
    exit;
  }

    if (delete_anggota($id_anggota) > 0 )
    {
        echo"<script> 
        alert('Data anggota Berhasil DiHapus');
        document.location.href='anggota.php';
        </script>";
    } else {
        echo"<script> 
        alert('Data anggota Gagal Diapus');
        document.location.href='anggota.php';
        </script>";

    }


    

