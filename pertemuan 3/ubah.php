<?php
    require 'functions.php';
    // cek nim
    $nim = $_GET['nim'];
    if ($nim > 0) {
        // ambil data dari database
        $query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
        $mhs = mysqli_fetch_assoc($query);
    }
?>

<?php

    if (isset($_POST['submit'])) {
        if(update($_POST) > 0) {
            echo "
                <script>
                    alert('data berhasil diubah');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('data gagal diubah');
                </script>
            ";
        }
    }

    // load data prodi
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
    <h3>Form Ubah Data</h3>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="gambarLama" value="<?= $mhs['gambar']; ?>">
        <table>
            <tr>
                <td>Nim</td>
                <td>:</td>
                <td><input readonly type="text" name="nim" value="<?= $mhs['nim'] ?>"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><input type="text" name="nama" value="<?= $mhs['nama'] ?>" required></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>:</td>
                <td>
                    <?php if($mhs['gender'] == 'L') : ?>
                        <input type="radio" value="L" name="gender" checked>L
                        <input type="radio" value="P" name="gender">P
                    <?php else : ?>
                        <input type="radio" value="L" name="gender">L
                        <input type="radio" value="P" name="gender" checked>P
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <td>Prodi</td>
                <td>:</td>
                <td>
                    <select name="prodi" id="prodi">
                    <?php
                        foreach($prodi as $p) {
                            if ($p['nama_prodi'] == $mhs['prodi']) {
                                $select = 'selected';
                            } else {
                                $select = '';
                            }
                            echo "<option value={$p['nama_prodi']} $select>" . $p['nama_prodi']. "</option>";
                        }                        
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Gambar</td>
                <td>:</td>
                <td><input type="file" name="gambar"></td>
                <td>
                    <img src="img/<?= $mhs['gambar'] ?>" width="50" alt="">
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
