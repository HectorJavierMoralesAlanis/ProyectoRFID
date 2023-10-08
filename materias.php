<?php 
    include ('DAO.php');
    $dao = new DAO();
    $consulta="SELECT * FROM Clases Where matriculaMaestro=:matricula";
    $parametros=array("matricula"=>$_POST['matricula']);
    $clases=$dao->ejecutarConsulta($consulta,$parametros);
    echo $clases;
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Materias</title>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <!--Navbar-->
  <nav class="main-header navbar navbar-expand navbar-dark">
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="../dashboard.php?id=<?php echo $_GET['id']?>" class="nav-link">Inventario</a>
          </li>
      </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Logo --->
      <a href="../dashboard.php?id=<?php echo $_GET['id']?>" class="brand-link">
          <img src="./lemur.png"  class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Admin</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Menu lateral-->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <li class="nav-item">
                          <a href="../../login.php" class="nav-link">
                              <p>
                                  Cerrar sesion
                              </p>
                          </a>
                      </li>
              </ul>
          </nav>
      </div>
  </aside>
  <!-- Fin del menu lateral -->
  <div class="content-wrapper">
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                  </div>
              </div>
          </div>
      </div>
  <!-- Contenido -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col">
                      <div class="card">
                          <!-- Header del contenido-->
                          <div class="card-header">
                              <h3 class="card-title">Materias</h3>
                              <!--Div para que el boton este a la derecha-->
                              <div class="btn-group" style="float: right;">
                                  <a href="./agregarInverntario.php?id=<?php echo $id?>" class="btn btn-block btn-success" style="float: right;">Agregar nueva materia</a>
                                  
                              </div>
                          </div>
                          <!-- Cuerpo del formulario-->
                          <div class="card-body">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>ID</th>
                                          <th>Materia</th>
                                          <th>Matricula del Maestro</th>
                                          <th>Editar</th>
                                          <th>Eliminar</th>
                                          <th>Detalles</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                  <!-- EXTRAE TODOS LOS DATOS DE LA TABLA EN LA BASE DE DATOS Y LOS MUESTRA AQUI -->
                                  <?php foreach ($clases as $clase) { ?>
                                  <tr>
                                      <td><?php echo $clase['id']; ?></td>
                                      <td><?php echo $clase['nombre']; ?></td>
                                      <td class="align-middle"><a href="./dahs.php?id=<?php echo $clase['matriculaMaestro']?>" method="POST" class="btn btn-info btn-block btn-sm">Ingresar</a></td>
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