<?php 

    include ('DAO.php');
    $dao = new DAO();
    $consulta = "SELECT * FROM Pase_de_lista Where clase=:id";
    $parametros = array("id"=>$_GET['id']);
    $alumnos = $dao->ejecutarConsulta($consulta,$parametros);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Asistencia</title>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col">
                      <div class="card">
                          <!-- Header del contenido-->
                          <div class="card-header">
                              <h3 class="card-title">Alumnos</h3>
                              <!--Div para que el boton este a la derecha-->
                              <div class="btn-group" style="float: right;">
                                  <a href="./agregarInverntario.php?id=<?php echo $id?>" class="btn btn-block btn-success" style="float: right;">Agregar nuevo alumno</a>
                              </div>
                          </div>
                          <!-- Cuerpo del formulario-->
                          <div class="card-body">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>Matricula</th>
                                          <th>Asistio</th>
                                          <th>Fecha de la asistencia</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <!-- EXTRAE TODOS LOS DATOS DE LA TABLA EN LA BASE DE DATOS Y LOS MUESTRA AQUI -->
                                  <?php foreach ($alumnos as $alumno) { ?>
                                  <tr>
                                      <td><?php echo $alumno['Matricula']; ?></td>
                                      <td><?php echo $alumno['Asistio']; ?></td>
                                      <td><?php echo $alumno['Fecha']; ?></td>
                                      <td><?php echo $alumno['hora'];?></td>
                                      <td class="align-middle"><a href="./borrar.php?id=<?php echo $alumno['id']?>&clase=<?php echo $alumno['clase']?>" method="POST" class="btn btn-info btn-block btn-sm">Eliminar</a></td>
                                  </tr>
                                  <?php }?>
                              </table>
                          </div>
                          <canvas id="myChart" width="400" height="400"></canvas>
                      </div>
                  </div>
              </div>
          </div>
      </section>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</body>
</html>