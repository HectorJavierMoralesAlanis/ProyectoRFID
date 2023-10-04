<?php
    $con = new mysqli("localhost","admin","587e608a4d7c61b1a289769b4f0eed9f2ba5e0edd903e117","listas");

    if ($con->connect_error){
        echo "Error: ".$connn->connect_error . PHP_EOL;
        die();
    }

    $rfid=$_POST["uid"];
    //$password=$_POST["contra"];
    $query = "SELECT * from lista";
    echo $query;
    $lista = query($query);
    echo $lista;
    if($lista['uid'] === $rfid){
        echo "Ingresado";
    }else{
        echo "Error: " . $conn->error;
    }

    $conn->close();
?>