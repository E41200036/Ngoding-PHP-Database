<?php

$conn = mysqli_connect("localhost", "root", "", "sistem_informasi");
if (!$conn) {
    echo "gagal";
}

// show data
function show($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function insert($data) {
    global $conn;

    $nim = htmlspecialchars($data['nim']);
    $nama = htmlspecialchars($data['nama']);
    $gender = htmlspecialchars($data['gender']);
    $prodi = htmlspecialchars($data['prodi']);


    // upload gambar
    $gambar = upload(); 

    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO `mahasiswa`(`nim`, `nama`, `gender`, `prodi`, `gambar`) 
              VALUES ('$nim', '$nama', '$gender', '$prodi', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    // mengambil properti gambar
    $name = $_FILES['gambar']['name'];
    $size = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    
    // cek upload gambar
    if ($error == 4) {
        echo "
            <script>
                alert('upload gambar dulu');
            </script>
        ";
        return false;
    }

    // cek ekstensi gambar
    $ekstensi = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $name);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensi)) {
        echo "
            <script>
                alert('upload file gambar saja');
            </script>
        ";
        return false;
    }

    // cek ukuran
    if ($size > 1000000) {
        echo "
            <script>
                alert('ukuran gambar terlalu besar');
            </script>
        ";
        return false;
    }

    // generate nama file
    $nameGen = uniqid();
    $nameFix = $nameGen . '.' . $ekstensiGambar;
    // var_dump($nameFix); die;
     // upload gambar
    move_uploaded_file($tmp_name, "img/" . $nameFix);

    return $nameFix;
}

function delete($data) {
    global $conn;
    $query = "DELETE FROM mahasiswa WHERE nim='$data'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($data) {
    global $conn;

    $nim = htmlspecialchars($data['nim']);
    $nama = htmlspecialchars($data['nama']);
    $gender = htmlspecialchars($data['gender']);
    $prodi = htmlspecialchars($data['prodi']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    // cek user memilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] == 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE `mahasiswa` 
              SET `nama`='$nama',`gender`='$gender',`prodi`='$prodi',`gambar`='$gambar' 
              WHERE `nim`='$nim'";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM mahasiswa 
              WHERE 
              nama LIKE '%$keyword%' OR
              nim LIKE '%$keyword%' OR
              prodi LIKE '%$keyword%'
              ";
    return show($query);
}

function register($data) {
    global $conn;

    $username = strtolower(stripslashes($data['username']));
    $password = mysqli_real_escape_string($conn, $data['password']);
    $password2 = mysqli_real_escape_string($conn, $data['password2']);
    $role_id = htmlspecialchars($data['role_id']);

    // cek username
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('username sudah terdaftar');
            </script>
        ";
        return false;
    }
    // cek konfirmasi password
    if ($password !== $password2) {
        echo "
                <script>
                    alert('konfirmasi password tidak sesuai');
                </script>
            ";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // menambah user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES (
        '', '$username', '$password', '$role_id'
    )");

    return mysqli_affected_rows($conn);
}