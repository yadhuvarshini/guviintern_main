<?php
    session_start();
    if(isset($_SESSION["username"])){
        echo json_encode(["code"=>true,"msg"=>"Already Logged In"]);
    }
    else{
        echo json_encode(["code"=>false,"msg"=>"Log In"]);
    }
?>