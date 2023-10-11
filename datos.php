<?php
    include ('DAO.php');
    $dao = new DAO();
    $daoLista = new DAO();
    $consulta = "SELECT * FROM Pase_de_lista Where clase=:id";
    $parametros = array("id"=>1);
    $alumnos = $dao->ejecutarConsulta($consulta,$parametros);
    $listaCompleta = "SELECT * FROM Alumnos Where clase=:id";
    $parametrosLista = array("id"=>1);
    $lista = $daoLista->ejecutarConsulta($listaCompleta,$parametrosLista);
    $totalLista = count($lista);
    foreach($lista as $id){
        echo " ";
        echo $id['Matricula'];
        echo " ";
        foreach($alumnos as $alumno){
            if (in_array($id['Matricula'],$alumnos)){
                echo $alumno['Asistio']; 
                echo $alumno['Fecha'];
                echo $alumno['hora'];
            } 
        }
    }
?>