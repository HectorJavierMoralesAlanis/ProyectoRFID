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
    $aux=0;
    
    foreach($lista as $id){
        echo " ";
        echo $id['Matricula'];
        echo " ";
        foreach($alumnos as $alumno){
            echo "<br/>";
//            $diademo = mktime(0,0,0,$alumno['Fecha']);

            $dia = date('d',$alumno['Fecha']);
            print_r ($dia);
            break;
            if (in_array($id['Matricula'],$alumno)){
                echo "<br/>";
                echo $alumno['Matricula'];
                echo "<br/>";
                echo $alumno['Asistio']; 
                echo $alumno['Fecha'];
                echo $alumno['hora'];
                echo "<br/>";
            }else {
                echo "<br/>";
                echo "sick love";
                echo "<br/>";
            }
            $aux=$aux+1;
        }
        break;
    }
?>