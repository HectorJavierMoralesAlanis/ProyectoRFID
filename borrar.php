<?php

    include("DAO.php");

    $id=$_GET['id'];
    $clase=$_GET['clase'];
    
    $dao2=new DAO();

    $consulta2 = "SELECT * FROM Clases WHERE id=:clase";

    $parametros2 = array('clase'=>$clase);

    $clases = $dao2->ejecutarConsulta($consulta2,$parametros2);
    
    $dao=new DAO();

    $consulta = "DELETE FROM Pase_de_lista WHERE id=:id";

    $parametros=array("id"=>$id);

    $resultados = $dao->insertarConsulta($consulta,$parametros);

    if($resultados>=0){
        foreach($clases as $id2){
            header("Location: http://134.122.22.100/dahs.php?id=$id2['id']");
        }
    }
?>