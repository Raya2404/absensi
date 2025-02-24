<?php

include("connect.php");

/*
$password = password_hash("123", PASSWORD_DEFAULT);

$sql = "INSERT INTO users(username, password, role) VALUES('dayat', '$password', 'user')";
$conn->query($sql);
*/
/*for($i = 1; $i < 32; $i++){
    $sql = "CREATE TABLE d$i(
    username VARCHAR(50) NOT NULL,
    date DATE NOT NULL,
    status ENUM('hadir', 'tidak hadir', 'terlambat', 'izin') NOT NULL DEFAULT 'tidak hadir',
    pulang ENUM('tepat waktu', 'lebih awal', 'lembur') NULL DEFAULT NULL,
    PRIMARY KEY(username)
    )";

    $conn->query($sql);
}*/

// drop all

$sql = "DROP TABLE 'd1',";
for($i = 2; $i < 32; $i++){
    $sql .= ",'d$i'";
}
$conn->query($sql);

?>