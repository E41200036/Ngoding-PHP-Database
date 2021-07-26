<?php
session_start();
require 'functions.php';
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
$nisn = $_GET['nisn'];
$result = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = $nisn");
$siswa = mysqli_fetch_assoc($result);


if (isset($_POST['submit'])) {
    if (update($_POST) > 0) {
        echo "<script>
                alert('update data siswa berhasil');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('update data siswa gagal');
            </script>";
        echo mysqli_error($conn);
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
    <h1>Form ubah</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="gambarLama" value="<?= $siswa['gambar'] ?>">
        <table>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td><input type="number" name="nisn" value="<?= $siswa['nisn'] ?>" readonly></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><input type="text" name="nama" value="<?= $siswa['nama'] ?>" required></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>
                    <?php if($siswa['kelas'] == 10) : ?>
                        <input type="radio" name="kelas" value="10" checked>10
                        <input type="radio" name="kelas" value="11">11
                        <input type="radio" name="kelas" value="12">12
                    <?php elseif($siswa['kelas'] == 11) : ?>
                        <input type="radio" name="kelas" value="10">10
                        <input type="radio" name="kelas" value="11" checked>11
                        <input type="radio" name="kelas" value="12">12
                    <?php elseif($siswa['kelas'] == 12) : ?>
                        <input type="radio" name="kelas" value="10">10
                        <input type="radio" name="kelas" value="11">11
                        <input type="radio" name="kelas" value="12" checked>12
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>
                    <select name="jurusan">
                        <?php 
                            $jurusan = show("SELECT jurusan FROM jurusan");
                            foreach($jurusan as $j) {
                                if($j['jurusan'] == $siswa['jurusan']) {
                                    $select = 'selected';
                                } else {
                                    $select = '';
                                }
                                echo "<option name='jurusan' value='" . $j['jurusan'] . "' $select>" . $j['jurusan'] . "</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>:</td>
                <td>
                    <input type="file" name="gambar">
                </td>
                <td><img src="img/<?= $siswa['gambar'] ?>" width="50" alt=""></td>
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