<?php
    include ('DAO.php');
    $dao = new DAO();
    $daoLista = new DAO();
    $consulta = "SELECT * FROM Pase_de_lista Where clase=:id";
    $parametros = array("id"=>$_GET['id']);
    $alumnos = $dao->ejecutarConsulta($consulta,$parametros);
    $listaCompleta = "SELECT * FROM Alumnos Where clase=:id";
    $parametrosLista = array("id"=>$_GET['id']);
    $lista = $daoLista->ejecutarConsulta($listaCompleta,$parametrosLista);
    $totalLista = count($lista);
    foreach($lista as $id){
        foreach($alumnos as $alumno){
            if (in_array($id['Matricula'],$alumnos)){
                echo $alumno['Asistio']; 
                echo $alumno['Fecha'];
                echo $alumno['hora'];
            } 
        }
    }
?>