<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: logout.php");
    exit();
}
$username = $_SESSION['username'];
    
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    if($row["role"] != "user"){
        header("Location: logout.php");
        exit();
    }
}else{
    header("Location: logout.php");
    exit();
}

$stmt->close();

$date = date("j");
$sql = "SELECT * FROM d$date WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


$status = "tidak hadir";

$date = date("d-m-Y");
if($result->num_rows > 0 && $row["date"] == $date){
    $status = $row["status"];
}

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
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.25);
            top: 0;
            left: 0;
            padding: 20px;
            width: 100%;
        }
        .header h2{
            margin: 20px;
        }
        h1{
            margin-top: 40px;
        }
        #absen{
            background-color: mediumseagreen;
            color: mintcream;
            padding: 15px;
            border: none;
            border-radius: 5px;
            width: 20%;
        }
        #absen:hover{
            background-color: mediumaquamarine;
            color: midnightblue;
        }
        #logout{
            background-color: red;
            color: mintcream;
            margin-top: 20px;
            padding: 15px;
            border: none;
            border-radius: 5px;
            width: 20%;
        }
        #logout:hover{
            background-color: #ff3f3f;
            color: midnightblue;
        }
    </style>
</head>
<body>
    <div class="header">
        <img width="60px" height="60px">
        <h2><?php echo "$username"; ?></h2>
    </div>

    <?php
        if($status != "tidak hadir"){
            echo "<h1>Anda sudah absen hari ini</h1><br>
                <h3>status : $status</h3>";
        }else{
            echo "<h1>Anda belum absen hari ini,\nSilahkan absen</h1><br>
            <button id='absen' onclick='window.location.href=\"absen.php\";'>Absen</button>";
        }
    ?>

    <br><br><hr>
    <button id="logout" onclick="window.location.href='logout.php';">logout</button>
</body>
</html>