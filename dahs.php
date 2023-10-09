<?php 

    include ('DAO.php');
    $dao = new DAO();
    $consulta = "SELECT * FROM Pase_de_lista Where clase=:id";
    $parametros = array("id"=>$_GET['id']);
    $alumnos = $dao->ejecutarConsulta($consulta,$parametros);
    $datos = [];
    $asistencia=[];
    $aux=0;
    //Obtner arreglo sin repeticiones
    /*foreach($alumnos as $id){
        if(in_array($id["Matricula"],$datos)){

        }else{
            $datos[$aux]=$id['Matricula'];
            //echo $datos[$aux];
     //       $asistencia = 1;
            //echo '\n';
            $aux=$aux+1;

        }
    }*/

    //Funcion para contar asistencia
    function asistencia_Matricula($matricula, $dao) {
        $consulta = "SELECT COUNT(*) AS asistencias FROM Pase_de_lista WHERE Matricula = :matricula AND Asistio = 1";
        $parametros = array("matricula" => $matricula);
        $asistencias = $dao->ejecutarConsulta($consulta, $parametros);
    
        return $asistencias[0]['asistencias'];
    }

    $asistencias = [];
    foreach ($alumnos as $alumno) {
        if(in_array($alumno['Matricula'],$asistencias)){

        }else{
            $asistencias[$alumno['Matricula']] = asistencia_Matricula($alumno['Matricula'], $dao);
        }
        echo "\n";
        echo count($asistencias);
    }
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
                          <h1>Gráfico de Ventas por Mes</h1>
                        <div class="container">
                            <canvas id="myChart" width="400" height="400"></canvas>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
</div>
</body>
<script>
    const alumnos = <?php echo json_encode($asistencias)?>
    var ctx = document.getElementById("myChart").getContext("2d");
    const asistenciaAlumnos = {
        label: "Asistencia",
        data: alumnos.map(alumno),
        backgroundColor: 'rgba(237,78,136, 0.2)', // Color de fondo
        borderColor: 'rgba(237,78,136, 1)', // Color del borde
        borderWidth: 1, // Ancho del borde
    }
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
        labels: [], // Inicializa las etiquetas vacías
        datasets: [{
            label: 'Alumnos',
            data: [], // Inicializa los datos vacíos
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color de fondo
            borderColor: 'rgba(75, 192, 192, 1)', // Color del borde
            borderWidth: 1 // Ancho del borde
        }]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });

    new Chart($grafica, {
        type: 'line', // Tipo de gráfica
        data: {
            labels: etiquetas,
            datasets: [
                asistenciaAlumnos,
                // Aquí más datos...
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            },
        }
    });
</script>
</html>