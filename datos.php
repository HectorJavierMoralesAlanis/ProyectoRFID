<?php
    include('DAO.php');
    $daoMaestro = new DAO();
    $consultaMaestro = "SELECT * FROM Profesores";
    $maestroLista = $daoMaestro->ejecutarConsulta($consultaMaestro);
    foreach($maestroLista as $maestro){
        //echo "Entro a maestros";
            //Se crean los dao
        $dao2Maestro = new DAO();
        $daoHora = new DAO();
        //Se obtiene la matricula del maestro
        $matricula="2030111";
           // Se establecen la hora
        date_default_timezone_set('America/Monterrey');
        $fecha=date('Y-m-d');
        $hora=date('07:00:00');
        $horaS = "$hora";
        echo "Hora variable \n ".$horaS.".\n";
            //Se obtiene la hora de la materia para designar el grupo del maestro
        $consultaHora = "SELECT * FROM Clases Where matriculaMaestro=:matricula";
        $parametrosHora = array("matricula"=>$matricula);
        $resultadoHora = $daoHora->ejecutarConsulta($consultaHora,$parametrosHora);
        foreach($resultadoHora as $horas){
            echo " Hora inicio ";
            echo $horas['hora'];
            echo " hora final ";
            echo $horas['hora_final'];
            if($horas['hora']>=$hora || $hroas['hora_final']>=$hora){
                echo "Always";
                $grupo=$horas['grupo'];
                $clase=$horas['id'];
                break;
            }
        }
        echo $grupo;
        echo $clase;
        $asistio=1;/*
        $consultaPase = "INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha,hora,grupo,clase)"."VALUES (:matricula,:asistio,:fecha,:hora,:grupo,:clase)";
        $parametrosPase = array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha,"hora"=>$hora,"grupo"=>$grupo,"clase"=>$clase);
        $paseMaestro = $dao2Maestro->ejecutarConsulta($consultaPase,$parametrosPase);*/
        break;

    }
    
?>