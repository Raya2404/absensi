<?php
include("connect.php");

unset($_SESSION["username"]);
header("location: login.php");
?>