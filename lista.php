<?php
    $conn = mysqli_connect("localhost","admin","587e608a4d7c61b1a289769b4f0eed9f2ba5e0edd903e117","listas");

    if ($conn->connect_error){
        echo "Error: ".$connn->connect_error . PHP_EOL;
        die();
    }
    $rfid=$_POST["uid"];
    //$password=$_POST["contra"];
    $query = "SELECT 'uid' from lista";
    //echo $query;
    $lista = mysqli_query($conn,$query);
    //echo "Ejemplo";
    echo $lista;
    if($lista['uid'] === $rfid){
        echo "Ingresado".PHP_EOL;
    }else{
        echo "Error: " . $conn->error;
    }
    $conn->close();
?>