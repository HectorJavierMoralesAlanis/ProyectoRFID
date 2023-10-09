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
            //echo $matricula;
            $consulta3="SELECT clase FROM Alumnos WHERE Matricula=:matricula";
            $parametros3=array("matricula"=>$matricula);
            $claseArreglo=$dao3->insertarConsulta($consulta3,$parametros3);
            $consulta4="SELECT grupo FROM Alumnos WHERE Matricula=:matricula";
            $parametros4=array("matricula"=>$matricula);
            $grupoArreglo=$dao3->insertarConsulta($consulta3,$parametros3);
            $fecha=date('Y-m-d H:i:s');
            //echo $fecha;
            foreach($claseArreglo as $id){
                $clase = $id['clase'];
            }
            foreach($grupoArreglo as $id){
                $grupo= $id['grupo'];
            }
            
            $asistio=1;
            $consulta2="INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha,grupo,clase)"."VALUES (:matricula,:asistio,:fecha,:grupo,:clase)";
            $parametros=array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha,"grupo"=>$grupo,"clase"=>$clase);
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
            $x=$x+1;
            //if ( $x ===count($alumnosListas)){
            //    echo "No se encontro la Matricula";
            //}
        }
        
    }
?>