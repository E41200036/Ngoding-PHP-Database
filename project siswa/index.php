<?php
session_start();
require 'functions.php';
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

$siswa = show("SELECT * FROM siswa");
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $siswa = show("SELECT * FROM siswa WHERE nisn LIKE '%$keyword%'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Daftar Siswa</h1>
    <a href="tambah.php"><button>Tambah data</button></a> | <a href="logout.php">logout</a><br><br>
    <form action="" method="POST">
        <input type="text" name="keyword" placeholder="nim" autofocus autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
    <table border="1" cellspacing=0 cellpadding=10>
        <tr>
            <th>NO</th>
            <th>NISN</th>
            <th>PROFILE</th>
            <th>NAMA</th>
            <th>KELAS</th>
            <th>JURUSAN</th>
            <th>MENU</th>
        </tr>
        <?php $i = 1 ?>
        <?php foreach ($siswa as $s) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $s['nisn']; ?></td>
                <td align="center"><img src="img/<?= $s['gambar']; ?>" width="50" alt=""></td>
                <td><?= $s['nama']; ?></td>
                <td><?= $s['kelas']; ?></td>
                <td><?= $s['jurusan']; ?></td>
                <td>
                    <a href="ubah.php?nisn=<?= $s['nisn'] ?>">ubah</a> |
                    <a href="hapus.php?nisn=<?= $s['nisn'] ?>" onclick="return alert('yakin ?'); ">hapus</a>
                </td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
    </table>
</body>

</html>