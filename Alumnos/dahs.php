<?php 
    include ('../DAO.php');
    $dao = new DAO();
    $daoMateria = new DAO();
    $consulta = "SELECT * FROM Pase_de_lista Where Matricula=:id";
    $parametros = array("id"=>$_GET['matricula']);
    $alumnos = $dao->ejecutarConsulta($consulta,$parametros);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <title>Asistencia</title>
  <style>
        .grafico {
            width: 400px;
            height: 300px;
            border: 1px solid #ccc;
        }
        .barra {
            background-color: blue;
            height: 30px;
            margin-bottom: 10px;
            color: white;
            text-align: center;
            line-height: 30px;
        }
    </style>
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
                                  <a href="../login.php" class="btn btn-block btn-success" style="float: right;">Regresar</a>
                              </div>
                          </div>
                          <!-- Cuerpo del formulario-->
                          <div class="card-body">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>Materia</th>
                                          <th>Asistio</th>
                                          <th>Fecha de la asistencia</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <!-- EXTRAE TODOS LOS DATOS DE LA TABLA EN LA BASE DE DATOS Y LOS MUESTRA AQUI -->
                                  <?php foreach ($alumnos as $alumno) { 
                                    $clase = $alumno['clase'];
                                    $consultaClase = "SELECT * FROM Clases Where id=:clase";
                                    $parametrosClase = array("clase"=>$clase);
                                    $claseArr = $daoMateria->ejecutarConsulta($consultaClase,$parametrosClase);
                                        foreach($claseArr as $id){
                                            $alumno['clase'] = $id['nombre'];
                                        }
                                    ?>
                                  <tr>
                                      <td><?php echo $alumno['clase']; ?></td>
                                      <td><?php echo $alumno['Asistio']; ?></td>
                                      <td><?php echo $alumno['Fecha']; ?></td>

                                  </tr>
                                  <?php }?>
                              </table>
                          </div>

                      </div>
                  </div>
              </div>
          </div>
      </section>
</div>
</body>
</html>