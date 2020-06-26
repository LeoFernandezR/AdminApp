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
            Crear Evento
            <small>llena el formulario para crear un evento</small>
          </h1>
        </section>
        <div class="row">
          <div class="col-md-8">
        <!-- Main content -->
            <section class="content">
              <!-- Default box -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Evento</h3>
                </div>
                <form class="form-horizontal reset" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-evento.php">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="usuario" class="col-sm-2 control-label">Titulo Evento: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="titulo_evento" name="titulo_evento" placeholder="Título del evento" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="categoria" class="col-sm-2 control-label">Categoria: </label>

                      <div class="col-sm-10">
                        <select name="categoria_evento" class="form-control select2" >
                          <option value="0" >- Seleccione -</option>
                        <?php
                          try {
                              $sql = "SELECT * FROM categoria_evento ";
                              $resultado = $conn->query($sql);
                              while ($cat_evento = $resultado->fetch_assoc()) { ?>
                                <option value="<?php echo $cat_evento['id_categoria']; ?>">
                                  <?php echo $cat_evento['cat_evento']; ?>
                                </option>
                             <?php }
                          } catch (Exception $e) {
                              echo "Error: " . $e->getMessage();
                          }?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Fecha Evento:</label>
                      <div class="col-sm-10">
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" name="fecha_evento">
                        </div>
                      </div>
                    </div>
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label class="control-label col-sm-2">Hora: </label>
                          <div class="col-sm-10">
                            <div class="input-group">
                              <input type="text" class="form-control timepicker" name="hora_evento">

                              <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="categoria" class="col-sm-2 control-label">Invitado o Ponente: </label>

                      <div class="col-sm-10">
                        <select name="invitado_evento" class="form-control select2" >
                          <option value="0" >- Seleccione -</option>
                        <?php
                          try {
                              $sql = "SELECT invitado_id, nombre_invitado, apellido_invitado FROM invitados ";
                              $resultado = $conn->query($sql);
                              while ($invitados = $resultado->fetch_assoc()) { ?>
                                <option value="<?php echo $invitados['invitado_id']; ?>">
                                  <?php echo $invitados['nombre_invitado'] . ' ' . $invitados['apellido_invitado']; ?>
                                </option>
                             <?php }
                          } catch (Exception $e) {
                              echo "Error: " . $e->getMessage();
                          }?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                  <input type="hidden" name="registro" value="nuevo">
                    <button type="submit" class="btn btn-info pull-right" >Añadir</button>
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