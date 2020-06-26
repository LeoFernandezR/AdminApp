<?php
$id = $_GET['id'];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die('Error');
}

include 'funciones/sesiones.php';
include 'funciones/funciones.php';
include 'templates/header.php';
include 'templates/barra.php';
include 'templates/navegacion.php';

?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Editar Invitado
            <small>llena el formulario para modificar un invitado</small>
          </h1>
        </section>
        <div class="row">
          <div class="col-md-8">
        <!-- Main content -->
            <section class="content">
              <!-- Default box -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Invitado</h3>
                </div>
                <?php
                        $sql = "SELECT * FROM invitados WHERE invitado_id = $id";
                        $resultado = $conn->query($sql);
                        $invitado = $resultado->fetch_assoc();
                    
                    ?>
                <form role="form" class="form-horizontal" name="guardar-registro" id="guardar-registro-archivo" method="POST" action="modelo-invitado.php" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombre_invitado" class="col-sm-2 control-label">Nombre: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Nombre" value="<?php echo $invitado['nombre_invitado']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="apellido_invitado" class="col-sm-2 control-label">Apellido: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Apellido" value="<?php echo $invitado['apellido_invitado']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="biografia_invitado" class="col-sm-2 control-label">Biografía: </label>

                      <div class="col-sm-10">
                       <textarea class="form-control" name="biografia_invitado" id="biografia_invitado" rows="8" placeholder="Biografía"><?php echo $invitado['descripcion']; ?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="imagen_actual" class="control-label col-sm-2">Imagen Actual: </label>

                        <div class="col-sm-10">
                            <img src="../img/invitados/<?php echo $invitado['url_imagen']; ?>" width="200px">

                        </div>
                    </div>
                    <div class="form-group">
                      <label for="imagen_invitado" class="col-sm-2 control-label">Imagen Nueva: </label>
                      <div class="col-sm-10">
                        <input type="file" name="archivo_imagen" id="imagen_invitado" class="form-control">

                        <p class="help-block">Añada la nueva del invitado aquí</p>

                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id" value="<?php echo $invitado['invitado_id']; ?>">
                    <button type="submit" class="btn btn-info pull-right" id="crear-registro">Editar</button>
                  </div>
                  <!-- /.box-footer -->
                </form>
              </div>
              <!-- /.box -->
            </section>
        <!-- /.content -->
          </div>
          <!-- Col-md-8 -->
        </div>
        <!-- Row -->
      </div>
      <!-- /.content-wrapper -->

     <?php
     include 'templates/footer.php'; ?>