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
    $gambar = htmlspecialchars($data['gambar']);

    $query = "INSERT INTO `mahasiswa`(`nim`, `nama`, `gender`, `prodi`, `gambar`) 
              VALUES ('$nim', '$nama', '$gender', '$prodi', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
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
    $gambar = htmlspecialchars($data['gambar']);

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