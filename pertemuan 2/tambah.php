<?php
require 'functions.php';
// cek tombol
if(isset($_POST['submit'])) {
    if(insert($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan');
                document.location.href = 'index.php';
            </script>
        ";
    }
}

// data prodi
$prodi = show("SELECT nama_prodi FROM prodi");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data</title>
</head>
<body>
    <h3>Form Tambah Data</h3>
    <form action="" method="POST">
        <table>
            <tr>
                <td>Nim</td>
                <td>:</td>
                <td><input type="text" name="nim" required></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>:</td>
                <td>
                    <input type="radio" value="L" name="gender">L
                    <input type="radio" value="P" name="gender">P
                </td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td>:</td>
                <td>
                    <select name="prodi" id="prodi">
                        <?php foreach($prodi as $p) : ?>
                            <option value="<?= $p['nama_prodi'] ?>"><?= $p['nama_prodi'] ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>:</td>
                <td><input type="text" name="gambar"></td>
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
