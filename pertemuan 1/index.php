<?php
// include file function
require 'functions.php';

// show data
$mahasiswa = show("select * from mahasiswa");

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
    <a href="tambah.php"><button>tambah data mahasiswa</button></a>
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
            <td><img src="img/user.png" width="50" alt=""></td>
            <td><?= $mhs['nim'] ?></td>
            <td><?= $mhs['nama'] ?></td>
            <td><?= $mhs['gender'] ?></td>
            <td><?= $mhs['prodi'] ?></td>
            <td>
                    <a href="">ubah</a>
                    <a href="">hapus</a>
            </td>
        </tr>
        <?php
            $i++;
            endforeach;
        ?>
    </table>
</body>
</html>