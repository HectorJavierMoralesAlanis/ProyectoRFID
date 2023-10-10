<?php
    include ('DAO.php');
    if(isset($_POST['matricula'],$_POST['clave'])){
        $dao = new DAO();
        $matricula=$_POST['matricula'];
        $consulta = "SELECT * FROM Profesores Where Matricula=:matricula and Contra=:contra";
        $consulta2 = "SELECT * FROM Alumnos Where Matricula=:matricula and Contra=:contra";
        $parametros=array("matricula"=>$_POST['matricula'],"contra"=>$_POST['clave']);
        $resultados=$dao->insertarConsulta($consulta,$parametros);
        $resultados2=$dao2->insertarConsulta($consulta2,$parametros);
        if($resultados>=0){
            header("Location: http://134.122.22.100/materias.php?matricula=$matricula");
        }else if($resultados2>=0){
            header("Location: http://134.122.22.100/Alumnos/dahs.php");
        }else{
            echo "error";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Login</title>
</head>
<body>
  <main class="vh-100">
        <div class="row d-flex justify-content-center align-content-center h-100">
            <div class="d-none d-md-flex align-items-center col-6 h-100">
                <img src="~/Images/svg/loginBackground.jpeg" class="img-fluid" alt="Responsive image"/>
            </div>

            <div class="col-12 col-md-6 h-100 justify-content-center align-content-center flex-wrap d-flex">
                <form class="w-75" method="POST" action="login.php">
                    <div class="d-flex my-4">
                        <h5 class="text-center fw-bold mb-0">Bienvenidos</h5>
                    </div>

                    <!-- input de Usuario -->
                    <div class="form-floating mb-4">
                        <input type="text" class="form-control" id="matricula" name="matricula">
                        <label for="floatingInput">Matricula</label>
                    </div>

                    <!-- input de Contraseña -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="clave" placeholder="clave" name="clave">
                        <label for="floatingPassword">Contraseña</label>
                    </div>

                    <div class="d-md-block d-grid text-end mt-4 pt-2">
                        <button type="submit" class="btn btn-primary" style="padding-left: 2.5rem; padding-right: 2.5rem" data-bind="click: login">
                            Aceptar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>
</html>