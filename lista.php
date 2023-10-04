<?php
    $con = new mysqli("localhost","admin","","lista");

    if ($con->connect_error){
        echo "Error: ".$connn->connect_error . PHP_EOL;
        die();
    }

    $rfid=$_POST["uid"];
    //$password=$_POST["contra"];
    $query = "SELECT * from lista";
    echo $query;
    $lista = query($query);

    if($lista['uid'] === $rfid){
        echo "Entro".PHP_EOL;
    }else{
        echo "Error: " . $conn->error;
    }

    $conn->close();
?>