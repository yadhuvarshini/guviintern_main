<?php
include 'connection.php';
session_start();
if (isset($_POST["update"])) {
    $username = $_SESSION["username"];
    $age = $_POST["age"];
    $dob = $_POST["dob"];
    $contact = $_POST["contact"];
    $city = $_POST["city"];
    $sql = "SELECT * FROM details WHERE username = ?";
    $statement = $con->prepare($sql);
    $statement->bind_param('s', $username);
    $statement->execute();
    $result = $statement->get_result();
    if ($result->num_rows > 0) {
        echo json_encode(["code" => false, "msg" => "User Details Already Updated"]);
    } else {
        $query = "INSERT INTO details (username,age,dob,contact,city) VALUES(?,?,?,?,?);";
        $statement = $con->prepare($query);
        $statement->bind_param('sisis', $username, $age, $dob, $contact, $city);
        $statement->execute();
        echo json_encode([
            "code" => true,
            "msg" => "User Details Updated",
            "username" => $username,
            "age" => $age,
            "dob" => $dob,
            "contact" => $contact,
            "city" => $city
        ]);

        $sql = "SELECT * FROM details WHERE username = ?";
        $statement = $con->prepare($sql);
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        $filename = "../data/details.json";
        $file = @fopen($filename, 'r+');
        if ($file == null) {
            $file = fopen($filename, 'w+');
        }
        if ($file) {
            fseek($file, 0, SEEK_END);
            if (ftell($file) > 0) {
                fseek($file, -1, SEEK_END);
                fwrite($file, ',', 1);
                fwrite($file, json_encode($result) . ']');
            } else {
                fwrite($file, json_encode(array($result)));
            }
            fclose($file);
        }
    }
}
?>