<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$attendance_status = "present";

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Absen</title>
    <style>
        body{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
            background-color: mintcream;
            padding: 0;
            margin: 0;
        }
        .header{
            background-color: cadetblue;
            display: flex;
            position: relative;
            align-content: center;
            top: 0;
            left: 0;
            padding: 20px;
            width: 100%;
        }
        .header h2{
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img width="60px" height="60px">
        <h2><?php echo "$username"; ?></h2>
    </div>
    <button>
        <a href="login.php">Logout</a>
    </button>
</body>
</html>