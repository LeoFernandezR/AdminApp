<?php
include 'funciones/sesiones.php';
include 'funciones/funciones.php';
include_once 'templates/header.php';
include 'templates/barra.php';
include 'templates/navegacion.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Listado de Personas Registradas
      <small></small>
    </h1>
  </section>
<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Maneja los visitantes registrados</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table id="registros" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha Registro</th>
                <th>Articulos</th>
                <th>Talleres</th>
                <th>Regalo</th>
                <th>Compra</th>
                <th>Acciones</th>
              </tr>
              </thead>
              <tbody>
                <?php
                try {
                    $sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados ";
                    $sql .= " JOIN regalos ";
                    $sql .= " ON registrados.regalo = regalos.id_regalo";
                    $resultado = $conn->query($sql);
                } catch (Exception $e) {
                    $error = 'Error: ' . $e->getMessage();
                    echo $error;
                }
                while ($registrados = $resultado->fetch_assoc()) { ?>
                  <tr>
                    <td>
                    <?php
                    echo $registrados['nombre_registrado'] . " " . $registrados['apellido_registrado'];

                    $pagado = $registrados['pagado'];
                    if ($pagado > 0) {
                        echo "<br><span class='badge bg-green'> Pagado </span>";
                    } else {
                        echo "<br><span class='badge bg-red'>No pagado </span>";
                    }
                    ?>
                    </td>
                    <td><?php echo $registrados['email_registrado'] ?></td>
                    <td><?php echo $registrados['fecha_registro'] ?></td>
                    <td>
                    <?php
                    $articulos = json_decode($registrados['pases_articulos'], true);
                    $arreglo_articulos = array(
                        "un_dia" => "Pase 1 Día",
                        "pase_2dias" => "Pase 2 Días",
                        "pase_completo" => "Pase Completo",
                        "camisas" => "Camisas",
                        "etiquetas" => "Etiquetas"

                    );
                    foreach ($articulos as $llave => $articulo) {
                        if (is_array($articulo) && array_key_exists('cantidad', $articulo)) {
                            echo $articulo['cantidad'] . " " . $arreglo_articulos[$llave]  . "<br>";
                        } else {
                            echo $articulo . " " . $arreglo_articulos[$llave]  . "<br>";
                        }
                    }
                    ?>
                    </td>
                    <td>
                    
                    <?php
                    
                    $eventos_resultado = $registrados['talleres_registrados'];
                    $talleres = json_decode($eventos_resultado, true);
                    
                    $talleres = implode("', '", $talleres['eventos']);

                    $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE clave IN ('$talleres') OR evento_id IN ('$talleres') ";

                    $resultado_talleres = $conn->query($sql_talleres);

                    $eventos = $resultado_talleres->fetch_assoc();

                    while ($eventos = $resultado_talleres->fetch_assoc()) {
                        echo $eventos['nombre_evento'] . " " . $eventos['fecha_evento'] . " " . $eventos['hora_evento'] . "<br>";
                    }
                    ?>
                    
                    
                    
                    </td>
                    <td><?php echo $registrados['nombre_regalo'] ?></td>
                    <td>$ <?php echo $registrados['total_pagado'] ?></td>
                    <td>
                      <a href="editar-registro.php?id=<?php echo $registrados['ID_Registrado']; ?>" class="btn bg-orange btn-flat margin"><i class="fa fa-pencil"></i></a>
                      <a href="#" data-id="<?php echo $registrados['ID_Registrado'];?>" data-tipo="registrado" class="btn bg-maroon btn-flat margin borrar-registro"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php }?>
              </tbody>
              <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha Registro</th>
                <th>Articulos</th>
                <th>Talleres</th>
                <th>Regalo</th>
                <th>Compra</th>
                <th>Acciones</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include 'templates/footer.php';
?>