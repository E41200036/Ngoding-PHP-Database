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
