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
            Crear Invitado
            <small>llena el formulario para crear un invitado</small>
          </h1>
        </section>
        <div class="row">
          <div class="col-md-8">
        <!-- Main content -->
            <section class="content">
              <!-- Default box -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Invitado</h3>
                </div>
                <form class="form-horizontal reset" name="guardar-registro" id="guardar-registro-archivo" method="POST" action="modelo-invitado.php" enctype="multipart/formdata">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombre_invitado" class="col-sm-2 control-label">Nombre: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Nombre" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="apellido_invitado" class="col-sm-2 control-label">Apellido: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Apellido" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="biografia_invitado" class="col-sm-2 control-label">Biografía: </label>

                      <div class="col-sm-10">
                       <textarea class="form-control" name="biografia_invitado" id="biografia_invitado" rows="8" placeholder="Biografía" required></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="imagen_invitado" class="col-sm-2 control-label">Imagen: </label>
                      <div class="col-sm-10">
                        <input type="file" name="archivo_imagen" id="imagen_invitado" class="form-control" required>

                        <p class="help-block">Añada la imagen del invitado aquí</p>

                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                  <input type="hidden" name="registro" value="nuevo">
                    <button type="submit" class="btn btn-info pull-right" id="crear-registro">Añadir</button>
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