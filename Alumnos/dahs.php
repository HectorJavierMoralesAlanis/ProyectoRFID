<?php 

    include ('../DAO.php');
    $dao = new DAO();
    $daoMateria = new DAO();
    $consulta = "SELECT * FROM Pase_de_lista Where Matricula=:id";
    $parametros = array("id"=>$_GET['matricula']);
    $alumnos = $dao->ejecutarConsulta($consulta,$parametros);

    foreach($alumnos as $alumno){
        $clase = $alumno['clase'];
    

        $consultaClase = "SELECT * FROM Clases Where id=:clase";
        $parametrosClase = array("clase"=>$clase);
        $clasesArr = $daoMateria->ejecutarConsulta($consultaClase,$parametrosClase);

        foreach($claseArr as $id){
            $alumno['clase']=$id['nombre'];
        }
    }

/*
    $datos = [];
    $asistencia=[];
    $aux=0;
    /*
    //Funcion para contar asistencia
    function asistencia_Matricula($matricula, $dao) {
        $consulta = "SELECT COUNT(*) AS asistencias FROM Pase_de_lista WHERE Matricula = :matricula AND Asistio = 1";
        $parametros = array("matricula" => $matricula);
        $asistencias = $dao->ejecutarConsulta($consulta, $parametros);
    
        return $asistencias[0]['asistencias'];
    }
    $x=0;
    $asistencias = [];
    foreach ($alumnos as $alumno) {
        if(in_array($alumno['Matricula'],$asistencias)){

        }else{
            $asistencias[$x] = asistencia_Matricula($alumno['Matricula'], $dao);
        }
        $x=$x+1;
    }
    
    $matriculas = [];
    foreach ($alumnos as $alumno) {
        if (!in_array($alumno['Matricula'], $matriculas)) {
            $matriculas[] = $alumno['Matricula'];
        }
    }
    function porcentaje_Asistencia($matricula, $dao) {
        $asistencias = asistencia_Matricula($matricula, $dao);
        $total_clases = 5;
        $porcentaje = $asistencias / $total_clases * 100;
    
        return $porcentaje;
    }
    
    $matriculas = [];
    $porcentajes = [];
    foreach ($alumnos as $alumno) {
        if (!in_array($alumno['Matricula'], $matriculas)) {
            $matriculas[] = $alumno['Matricula'];
            $porcentajes[] = porcentaje_Asistencia($alumno['Matricula'], $dao);
        }
    } */
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
                                  <a href="./materias.php?matricula=<?php echo $_GET['matricula']?>" class="btn btn-block btn-success" style="float: right;">Regresar</a>
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
                                      <td><?php echo $alumno['clase']; ?></td>
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
                        <h1>Grafico porcentaje</h1>
                        <div class="container">
                            <canvas id="myChart2" width="400" height="400"></canvas>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
</div>
</body>
<script>
    const alumnos = <?php echo json_encode($asistencias);?>;
    const nMatriculas = <?php echo json_encode($matriculas);?>;
    const asistenciaPorcentaje = <?php echo json_encode($porcentajes);?>;
    console.log(alumnos);
    function getRandomColor() {
        const colors = ["#ff0000", "#00ff00", "#0000ff", "#ffff00", "#ff00ff", "#00ffff"];
        return colors[Math.floor(Math.random() * colors.length)];
    }
    var ctx = document.getElementById("myChart").getContext("2d");
    var ctx2 = document.getElementById("myChart2").getContext("2d");

    const asistenciaAlumnos = {
        label: "Asistencia",
        data: alumnos.map(alumno => alumno),
        backgroundColor: 'rgba(237,78,136, 0.2)', // Color de fondo
        borderColor: 'rgba(237,78,136, 1)', // Color del borde
        borderWidth: 1, // Ancho del borde
    };
    const asistenciaPor = {
        label: "Porcentaje",
        data: asistenciaPorcentaje.map(asisP => asisP),
        backgroundColor: asistenciaPorcentaje.map(asisP => getRandomColor()), // Color de fondo aleatorio para cada sector
        borderColor: "rgba(0,0,0, 1)", // Color del borde
        borderWidth: 1, // Ancho del borde
    };
    var myChart = new Chart(ctx, {
        type: 'line', // Tipo de gráfica
        data: {
            labels: nMatriculas.map(nmat => nmat),
            datasets: [
                asistenciaAlumnos,
                // Aquí más datos...
            ]
        },
        options: {
        scales: {
            y: {
            beginAtZero: true
            }
        }
        }
    });


    // Creamos un nuevo gráfico
    var myChart = new Chart(ctx2, {
        type: "pie", // Tipo de gráfica circular
        data: {
            labels: nMatriculas.map(nmat => nmat),
            datasets: [asistenciaPor],
        },
        options: {
            scales: {
            y: {
                beginAtZero: true,
            },
            },
        },
    });
</script>
</html>