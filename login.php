<?php
session_start();
include 'connect.php';


$error = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            if($row["role"] == "admin"){
                header("location: dashboard.php");
            }else{
                header("location: absensi.php");
            }
        } else {
            $error = 2;
        }
    } else {
        $error = 1;
    }
    
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: mintcream;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            display: flex;
            justify-content: center;
            padding: 10px 40px 40px 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.15);
        }
        h2{
            color: midnightblue;
            font-size: 40px;
            display: flex;
            justify-content: center;
        }
        label{
            display: block;
            margin: 5px;
        }
        input{
            width: 90%;
            margin-top: 5px;
            margin-bottom: 10px;
            margin-left: 5px;
            margin-right: 5px;
        }
        .login-container .error-message{
            display: flex;
            justify-content: center;
            color: red;
            font-size: 14px;
        }
        button {
            background-color: mediumseagreen;
            color: white;
            font-size: 14px;
            border: none;
            cursor: pointer;
            padding: 10px;
            margin-top: 20px;
            width: 100%;
            border-radius: 5px;
        }
        button:hover {
            background-color: mediumaquamarine;
            color: black;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST" action="login.php">
            <h2>Login</h2><br>
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <?php switch($error){ 
                    case 1:
                        echo "<div class='error-message' >Akun tidak ditemukan</div>";
                        break;
                    case 2:
                        echo "<div class='error-message' >password salah</div>";
                        break; 
                    }?>
            
            <br>
            <button type="submit" name="action" value="login">Login</button>
        </form>
    </div>
</body>
</html>
