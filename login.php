<?php
    include ('DAO.php');
    //$dao new DAO();
    //$consulta = "SELECT * FROM Profesores";
    //$listaProfesores = $dao->ejecutarConsulta($consulta);
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
                <form class="w-75">
                    <div class="d-flex my-4">
                        <h5 class="text-center fw-bold mb-0">Bienvenidos</h5>
                    </div>

                    <!-- input de Usuario -->
                    <div class="form-floating mb-4">
                        <input type="email" class="form-control" id="floatingInput" placeholder="User" data-bind="value: user().username">
                        <label for="floatingInput">Usuario</label>
                    </div>

                    <!-- input de Contraseña -->
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" data-bind="value: user().password">
                        <label for="floatingPassword">Contraseña</label>
                    </div>

                    <div class="d-md-block d-grid text-end mt-4 pt-2">
                        <button type="button" class="btn btn-primary" style="padding-left: 2.5rem; padding-right: 2.5rem" data-bind="click: login">
                            Aceptar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>
</html>