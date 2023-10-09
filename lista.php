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
    $x=0;
    foreach ($alumnosLista as $alumno){
        /*
        echo "\ncontra mandada ";
        echo $rfid;
        echo "\nContra base ";
        echo $alumno['Contra'];
        */
        if($alumno['IDcard'] === $rfid){
            $dao2 = new DAO();
            $dao3 = new DAO();
            $dao4 = new DAO();
            echo "Ingresado";
            $matricula=$alumno['Matricula'];
            $consulta3 = "SELECT clase FROM Alumnos WHERE Matricula =: matricula";
            $sentencia3 = array("matricula"=>$matricula);
            $clase = $dao4->ejecutarConsulta($consulta3,$parametros3);
            $consulta4 = "SELECT grupo FROM Alumnos WHERE Matricula =: matricula";
            $sentencia4 = array("matricula"=>$matricula);
            $grupo = $dao4->ejecutarConsulta($consulta4,$parametros4); 
            //echo $matricula;                  
            $fecha=date('Y-m-d H:i:s');
            //echo $fecha;
            $asistio=1;
            $consulta2="INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha,grupo,clase)"."VALUES (:matricula,:asistio,:fecha,:grupo,:clase)";
            $parametros=array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha,"grupo"=>$grupo,"clase"=>$clase);
            $pase = $dao2->insertarConsulta($consulta2,$parametros);
            break;
            //Se cambio la forma de verificar
        }else if($alumno['Contra']===$rfid){
            $dao2 = new DAO();
            $dao3 = new DAO();
            $dao4 = new DAO();
            echo "Ingresado";
            $matricula=$alumno['Matricula'];
            $consulta3 = "SELECT clase FROM Alumnos WHERE Matricula =: matricula";
            $sentencia3 = array("matricula"=>$matricula);
            $clase = $dao4->ejecutarConsulta($consulta3,$parametros3);
            $consulta4 = "SELECT grupo FROM Alumnos WHERE Matricula =: matricula";
            $sentencia4 = array("matricula"=>$matricula);
            $grupo = $dao4->ejecutarConsulta($consulta4,$parametros4); 
            //echo $matricula;                  
            $fecha=date('Y-m-d H:i:s');
            //echo $fecha;
            $asistio=1;
            $consulta2="INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha,grupo,clase)"."VALUES (:matricula,:asistio,:fecha,:grupo,:clase)";
            $parametros=array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha,"grupo"=>$grupo,"clase"=>$clase);
            $pase = $dao2->insertarConsulta($consulta2,$parametros);
            break;
        }else{
            $x=$x+1;
            //if ( $x ===count($alumnosListas)){
            //    echo "No se encontro la Matricula";
            //}
        }
        
    }
?>