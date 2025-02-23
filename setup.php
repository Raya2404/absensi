<?php
include("connect.php");

for ($i = 1; $i <= 31; $i++) {
    $tableName = "d" . $i;
    $sql = "CREATE TABLE IF NOT EXISTS `$tableName` (
        username VARCHAR(50) NOT NULL,
        date DATE NOT NULL,
        status ENUM('hadir', 'tidak hadir', 'terlambat', 'izin') NOT NULL DEFAULT 'tidak hadir'
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table $tableName created successfully.<br>";
    } else {
        echo "Error creating table $tableName: " . $conn->error . "<br>";
    }
}

$conn->close();
?>