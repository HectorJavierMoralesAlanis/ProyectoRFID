<?php
    include('DAO.php');
    $dao =new DAO();
    $consulta = "SELECT * FROM Pase_de_lista Where clase=:id";
    $parametros = array("id"=>$_GET['id']);
    $alumnos = $dao->ejecutraConsulta($consulta,$parametros);
    
?>