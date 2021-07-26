<?php
session_start();
require 'functions.php';
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

if (isset($_POST['submit'])) {
    if (insert($_POST) > 0) {
        echo "<script>
                alert('tambah data siswa berhasil');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('tambah data siswa gagal');
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Form tambah</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td><input type="number" name="nisn" required></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>
                    <input type="radio" name="kelas" value="10">10
                    <input type="radio" name="kelas" value="11">11
                    <input type="radio" name="kelas" value="12">12
                </td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>
                    <select name="jurusan">
                        <option value="RPL">RPL</option>
                        <option value="TB">TB</option>
                        <option value="TPMI">TPMI</option>
                        <option value="TITL">TITL</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>:</td>
                <td>
                    <input type="file" name="gambar">
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><button type="submit" name="submit">Submit</button> | <a href="index.php">kembali</a></td>
            </tr>
        </table>
    </form>
</body>
</html>