<?php
    $con = new mysqli("localhost","admin","","pase_lista");

    if ($con->connect_error){
        echo "Error: ".$connn->connect_error . PHP_EOL;
        die();
    }

    $rfid=$_POST["uid"];
    $password=$_POST["contra"];

    $query = "SELECT * from lista";

    $lista = query($query);

    if($lista['uid'] === $rfid || $lista['contra'] === $password){
        echo "Entro".PHP_EOL;
    }else{
        echo "Error: " . $conn->error;
    }

    $conn->close();
?>