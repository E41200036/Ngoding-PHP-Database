<?php
session_start();
require 'functions.php';
if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}

$nisn = $_GET['nisn'];

mysqli_query($conn, "DELETE FROM siswa WHERE nisn = '$nisn'");
echo "<script>
            alert('hapus data berhasil');
            document.location.href = 'index.php';
      </script>";
