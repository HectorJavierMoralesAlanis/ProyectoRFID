<?php
    include('DAO.php');
    $dao3 = new DAO();
    $dao4 = new DAO();
    $matricula=20301031;
    //echo $matricula;
    $consulta3="SELECT * FROM Alumnos WHERE Matricula=:matricula";
    $parametros3=array("matricula"=>$matricula);
    $claseArreglo=$dao3->insertarConsulta($consulta3,$parametros3);
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
        $clase = $id;
    }
    foreach($grupoArreglo as $id){
        $grupo= $id['grupo'];
    }
    echo $clase;
    
?>