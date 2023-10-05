<?php
    include ('DAO.php');
    $dao = new DAO();
    $consulta1 = "SELECT * FROM Alumnos";
    $alumnosLista = $dao->ejecutarConsulta($consulta1);

    if ($conn->connect_error){
        echo "Error: ".$connn->connect_error . PHP_EOL;
        die();
    }
    $rfid=$_POST["uid"];
    //$password=$_POST["password"];
    //echo $alumnosLista;
    foreach ($alumnosLista as $alumno){
        echo $rfid;
        echo $alumno['Contra'];
        if($alumno['IDcard'] === $rfid){
            $dao2 = new DAO();
            echo "Ingresado";
            $matricula=$alumno['Matricula'];
            //echo $matricula;
            $fecha=date('Y-m-d H:i:s');
            //echo $fecha;
            $asistio=1;
            $consulta2="INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha)"."VALUES (:matricula,:asistio,:fecha)";
            $parametros=array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha);

            $pase = $dao2->insertarConsulta($consulta2,$parametros);
            break;
            //Se cambio la forma de verificar
        }else if($alumno['Contra']===$rfid){
            $dao2 = new DAO();
            echo "Ingresado";
            
            $matricula=$alumno['Matricula'];
            //echo $matricula;
            $fecha=date('Y-m-d H:i:s');
            //echo $fecha;
            $asistio=1;
            $consulta2="INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha)"."VALUES (:matricula,:asistio,:fecha)";
            $parametros=array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha);

            $pase = $dao2->insertarConsulta($consulta2,$parametros);
            break;
        }else{
            echo "No se encontro la Matricula";
        }
        
    }
?>