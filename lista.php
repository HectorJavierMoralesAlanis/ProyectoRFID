<?php
    //$conn = mysqli_connect("localhost","admin","587e608a4d7c61b1a289769b4f0eed9f2ba5e0edd903e117","listas");
    include ('DAO.php');
    $dao = new DAO();
    $consulta1 = "SELECT * FROM Alumnos";
    $alumnosLista = $dao->ejecutarConsulta($consulta1);

    if ($conn->connect_error){
        echo "Error: ".$connn->connect_error . PHP_EOL;
        die();
    }
    $rfid=$_POST["uid"];
    //$password=$_POST["contra"];
    //$query = 'SELECT * FROM lista';
    //echo $query;
    //$lista = mysqli_query($conn,$query);
    //echo "Ejemplo";
    echo $alumnosLista;
    foreach ($alumnosLista as $alumno){
        echo $alumno['IDcard'];
    
        if($alumno['IDcard'] === $rfid){
            $dao2 = new DAO();
            //echo "Ingresado";
            $matricula=$alumno['Matricula'];
            echo $matricula;
            $fecha=date('Y-m-d H:i:s');
            //echo $fecha;
            $asistio=True;
            $consulta2="INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha)"."VALUES (:matricula,:asistio,:fecha)";
            $parametros=array("matricula"=>$matricula,$asistio,'fecha'=$fecha);
            //$pase = $dao2->insertarConsulta($consulta2,$parametros);
        }else{
            echo "No se encontro la Matricula";
        }

    }
?>