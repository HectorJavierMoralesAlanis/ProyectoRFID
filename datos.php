<?php
    include('DAO.php');
    $dao3 = new DAO();
    $dao4 = new DAO();
    $matricula=2030103;
    //echo $matricula;
    $consulta3="SELECT clase FROM Alumnos WHERE Matricula=:matricula";
    $parametros3=array("matricula"=>$matricula);
    $claseArreglo=$dao3->insertarConsulta($consulta3,$parametros3);
    $consulta4="SELECT grupo FROM Alumnos WHERE Matricula=:matricula";
    $parametros4=array("matricula"=>$matricula);
    $grupoArreglo=$dao4->insertarConsulta($consulta4,$parametros4);
    $fecha=date('Y-m-d H:i:s');
    //echo $fecha;
    foreach($claseArreglo as $id){
        $clase = $id;
    }
    foreach($grupoArreglo as $id){
        $grupo= $id['grupo'];
    }
    echo $clase;
?>