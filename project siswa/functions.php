<?php

$conn = mysqli_connect("localhost", "root", "", "sekolah");

function show($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function upload()
{
    $name = $_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];

    if ($error == 4) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
            return false;
    }

    if ($size > 1000000) {
        echo "<script>
                alert('gambar terlalu besar');
            </script>";
            return false;
    }

    $extensionList = ['jpg', 'jpeg', 'png'];
    $extension = explode('.', $name);
    $extension = strtolower(end($extension));

    if (!in_array($extension, $extensionList)) {
        echo "<script>
                alert('hanya upload gambar');
            </script>";
            return false;
    }

    $name = uniqid();
    $nameGen = $name . "." . $extension;
    move_uploaded_file($tmp_name, "img/$nameGen");
    
    return $nameGen;

}

function insert($data) {
    global $conn;
    $nisn = htmlspecialchars($data['nisn']);
    $nama = htmlspecialchars($data['nama']);
    $kelas = htmlspecialchars($data['kelas']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambar = upload();
    if (!$gambar) {
        echo "<script>
                alert('pilih gambar terlebih dahulu');
            </script>";
            return false;
    } else {
        mysqli_query($conn, "INSERT INTO `siswa`(`nisn`, `nama`, `kelas`, `jurusan`, `gambar`) VALUES ($nisn,'$nama', $kelas,'$jurusan','$gambar')");

        return mysqli_affected_rows($conn);
    }
}

function update($data)
{
    global $conn;
    $nisn = htmlspecialchars($data['nisn']);
    $nama = htmlspecialchars($data['nama']);
    $kelas = htmlspecialchars($data['kelas']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE `siswa` 
                SET `nama`='$nama',`kelas`='$kelas',`jurusan`='$jurusan',`gambar`='$gambar' 
                WHERE `nisn`='$nisn'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

}

function register($data)
{
    global $conn;
    $username = htmlspecialchars($data['username']);
    $password = mysqli_escape_string($conn, $data['password']);
    $password2 = mysqli_escape_string($conn, $data['password2']);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_num_rows($result)) {
        echo "<script>
                alert('username sudah terdaftar');
            </script>";
        return false;
    } else {
        if ($password !== $password2) {
            echo "<script>
                    alert('konfirmasi password salah');
                </script>";
            return false;
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO `user`(`id_user`, `username`, `password`) VALUES ('','$username','$password')");

            return mysqli_affected_rows($conn);
        }
    }
}
