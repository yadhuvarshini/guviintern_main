<?php
$host = "localhost";
$user = "root";
$password = '';
$db_name = "guvi";

$con = new mysqli($host, $user, $password);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

mysqli_select_db($con, $db_name);
?>