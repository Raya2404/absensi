<?php
include("connect.php");
session_start();

$username = $_SESSION["username"];
$sql = "SELECT role FROM users WHERE username = '$username'";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// check user role
if($result){
    $row = $result->fetch_assoc();
    if($row["role"] != "admin"){
        $http = "location: absensi.php";
    }else{
        $http = "location: dashboard.php";
    }
}

$d = date("j");
$date = date("Y-m-d");
$time = date("H:i");

$sql = "SELECT * FROM d$d WHERE username= ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


header($http);



?>

<html>
<head>
    <title>absen</title>
</head>
<body>
    <style>
        body{
            background-color: mintcream;
            justify-content: center;
            padding: 40px;
        }
        h1{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        button{
            background-color: red;
            color: white;
            padding: 20px;
            width: 20%;
        }
        button:hover{
            background-color: #ff3f3f;
            color: midnightblue;
        }
    </style>
</body>
</html>