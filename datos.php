<?php
    include('DAO.php');
    $dao2 = new DAO();
    $dao3 = new DAO();
    $dao4 = new DAO();
    $matricula=20301031;
    //echo $matricula;
    $consulta3="SELECT * FROM Alumnos WHERE Matricula=:matricula";
    $parametros3=array("matricula"=>$matricula);
    $claseArreglo=$dao3->ejecutarConsulta($consulta3,$parametros3);
    echo "Esto esto es directo.\n";
    echo $claseArreglo;
    $consulta4="SELECT grupo FROM Alumnos WHERE Matricula=:matricula";
    $parametros4=array("matricula"=>$matricula);
    $grupoArreglo=$dao4->ejecutarConsulta($consulta4,$parametros4);
    echo "Esto es con ejecutar.\n";
    echo $grupoArreglo;
    $fecha=date('Y-m-d H:i:s');
    //echo $fecha;
    foreach($claseArreglo as $id){
        $clase = $id['clase'];
    }
    foreach($grupoArreglo as $id){
        $grupo= $id['grupo'];
    }
    echo $grupo;
    $asistio=1;
    $consulta2="INSERT INTO Pase_de_lista (Matricula,Asistio,Fecha,grupo,clase)"."VALUES (:matricula,:asistio,:fecha,:grupo,:clase)";
    $parametros=array("matricula"=>$matricula,"asistio"=>$asistio,"fecha"=>$fecha,"grupo"=>$grupo,"clase"=>$clase);
    $pase = $dao2->ejecutarConsulta($consulta2,$parametros);
    
?>