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
        echo $grupo;
        echo $clase;
        $asistio=1;
        $consultaPase = "INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha,hora,grupo,clase)"."VALUES (:matricula,:asistio,:fecha,:hora,:grupo,:clase)";
        $parametrosPase = array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha,"hora"=>$hora,"grupo"=>$grupo,"clase"=>$clase);
        $paseMaestro = $dao2Maestro->ejecutarConsulta($consultaPase,$parametrosPase);
        break;

    }
    
?>