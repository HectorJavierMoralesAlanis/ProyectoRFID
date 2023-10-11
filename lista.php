<?php
    include ('DAO.php');
    $dao = new DAO();
    $daoMaestro = new DAO();
    $consulta1 = "SELECT * FROM Alumnos";
    $consultaMaestro = "SELECT * FROM Profesores";
    $alumnosLista = $dao->ejecutarConsulta($consulta1);
    $maestroLista = $dao->ejecutarConsulta($consultaMaestro);
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
            $var = "Ingresado";
            $matricula=$alumno['Matricula'];
            //echo $matricula;
            $consulta3="SELECT clase FROM Alumnos WHERE Matricula=:matricula";
            $parametros3=array("matricula"=>$matricula);
            $claseArreglo=$dao3->ejecutarConsulta($consulta3,$parametros3);
            $consulta4="SELECT grupo FROM Alumnos WHERE Matricula=:matricula";
            $parametros4=array("matricula"=>$matricula);
            $grupoArreglo=$dao4->ejecutarConsulta($consulta4,$parametros4);
            date_default_timezone_set('America/Monterrey');
            $fecha=date('Y-m-d');
            $hora=date('H:i:s');
            //echo $fecha;
            foreach($claseArreglo as $id){
                $clase = $id['clase'];
            }
            foreach($grupoArreglo as $id){
                $grupo= $id['grupo'];
            }
            
            $asistio=1;
            $consulta2="INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha,hora,grupo,clase)"."VALUES (:matricula,:asistio,:fecha,:hora,:grupo,:clase)";
            $parametros=array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha,"hora"=>$hora,"grupo"=>$grupo,"clase"=>$clase);
            $pase = $dao2->ejecutarConsulta($consulta2,$parametros);
            break;
            //Se cambio la forma de verificar
        }else if($alumno['Contra']===$rfid){
            $dao2 = new DAO();
            $dao3 = new DAO();
            $dao4 = new DAO();
            echo "Ingresado";
            $matricula=$alumno['Matricula'];
            //echo $matricula;
            $consulta3="SELECT clase FROM Alumnos WHERE Matricula=:matricula";
            $parametros3=array("matricula"=>$matricula);
            $claseArreglo=$dao3->ejecutarConsulta($consulta3,$parametros3);
            $consulta4="SELECT grupo FROM Alumnos WHERE Matricula=:matricula";
            $parametros4=array("matricula"=>$matricula);
            $grupoArreglo=$dao4->ejecutarConsulta($consulta4,$parametros4);
            date_default_timezone_set('America/Monterrey');
            $fecha=date('Y-m-d');
            $hora=date('H:i:s');
            //echo $fecha;
            foreach($claseArreglo as $id){
                $clase = $id['clase'];
            }
            foreach($grupoArreglo as $id){
                $grupo= $id['grupo'];
            }
            
            $asistio=1;
            $consulta2="INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha,hora,grupo,clase)"."VALUES (:matricula,:asistio,:fecha,:hora,:grupo,:clase)";
            $parametros=array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha,"hora"=>$hora,"grupo"=>$grupo,"clase"=>$clase);
            $pase = $dao2->ejecutarConsulta($consulta2,$parametros);
            break;
        }else{
            $x=$x+1;
        }

    }
    foreach($maestroLista as $maestro){
        //echo "Entro a maestros";
        if($maestro['IDcard']===$rfid){
            //Se crean los dao
            $dao2Maestro = new DAO();
            $daoHora = new DAO();
            //Se obtiene la matricula del maestro
            $matricula=$maestro['Matricula'];
            // Se establecen la hora
            date_default_timezone_set('America/Monterrey');
            $fecha=date('Y-m-d');
            $hora=date('07:00:00');
            //Se obtiene la hora de la materia para designar el grupo del maestro
            $consultaHora = "SELECT * FROM Clases Where matriculaMaestro=:matricula";
            $parametrosHora = array("matricula"=>$matricula);
            $resultadoHora = $daoHora->ejecutarConsulta($consultaHora,$parametrosHora);
            foreach($resultadoHora as $horas){
                if($horas['hora']>=$hora && $horas['hora_final']<=$hora){
                    $grupo=$horas['grupo'];
                    $clase=$horas['id'];
                }
            }
            $asistio=1;
            $consultaPase = "INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha,hora,grupo,clase)"."VALUES (:matricula,:asistio,:fecha,:hora,:grupo,:clase)";
            $parametrosPase = array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha,"hora"=>$hora,"grupo"=>$grupo,"clase"=>$clase);
            $paseMaestro = $dao2Maestro->ejecutarConsulta($consultaPase,$parametrosPase);
            break;
        }
        break;
    }//if ( $x ===count($alumnosListas)){
            //    echo "No se encontro la Matricula";
            //}
        //}
        
    //}*/
?>