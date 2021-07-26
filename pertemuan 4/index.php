<?php
// include file function
require 'functions.php';

$mahasiswa = show("select * from mahasiswa");
if (isset($_POST['cari'])) {
    $mahasiswa = cari($_POST['keyword']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h3>Data Mahasiswa</h3>
    <a href="tambah.php"><button>tambah data mahasiswa</button></a><br><br>
    <form action="" method="POST">
        <input type="text" name="keyword" autofocus size="40" placeholder="masukan keyword pencarian" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form>
    <table border="1" cellspacing=0 cellpadding=10>
        <tr>
            <th>No</th>
            <th>Profile</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Prodi</th>
            <th>Menu</th>
        </tr>
        <?php 
            $i = 1;
            foreach($mahasiswa as $mhs) :
        ?>
        <tr>
            <td><?= $i ?></td>
            <td><img src="img/<?= $mhs['gambar'] ?>" width="50" alt=""></td>
            <td><?= $mhs['nim'] ?></td>
            <td><?= $mhs['nama'] ?></td>
            <td><?= $mhs['gender'] ?></td>
            <td><?= $mhs['prodi'] ?></td>
            <td>
                    <a href="ubah.php?nim=<?= $mhs['nim'] ?>">ubah</a>
                    <a href="hapus.php?nim=<?= $mhs['nim'] ?>" onclick="return confirm('apakah kamu yakin ?')">hapus</a>
            </td>
        </tr>
        <?php
            $i++;
            endforeach;
        ?>
    </table>
</body>
</html>