<?php
 $redis = new Redis(); 
 $redis->connect('127.0.0.1', 6379); 
include './connection.php';
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $sql = "SELECT * FROM auth WHERE username = ? AND password = ? ";
    $statement = $con->prepare($sql);
    $statement->bind_param('ss', $username, $password);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows > 0) {
        // session_start();
        $redis->set("user" , $username);
        echo json_encode(["code" => true, "msg" => "Success : Logged In"]);
    } else {
        echo json_encode(["code" => false, "msg" => "Failure : Invalid Credentials"]);
    }
}
if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $query = "SELECT * FROM auth WHERE username=?";
    $statement = $con->prepare($query);
    $statement->bind_param('s', $username);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows > 0) {
        echo json_encode(["code" => false, "msg" => "Failure : User Already Exists"]);
    } else {
        $query = "INSERT INTO auth (username,password) VALUES(?,?);";
        $statement = $con->prepare($query);
        $statement->bind_param('ss', $username, $password);
        $statement->execute();
        // session_start();
        $redis->set("user" , $username);
        echo json_encode(["code" => true, "msg" => "Success : User Registered Succesfully"]);
    }
}
?>