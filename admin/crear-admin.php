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
            Crear Administrador
            <small>llena el formulario para crear un administrador</small>
          </h1>
        </section>
        <div class="row">
          <div class="col-md-8">
        <!-- Main content -->
            <section class="content">
              <!-- Default box -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Administrador</h3>
                </div>
                <form class="form-horizontal reset" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-admin.php">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="usuario" class="col-sm-2 control-label">Usuario: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
                      </div>
                    </div><div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Nombre: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Password" class="col-sm-2 control-label">Contraseña: </label>

                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Password" class="col-sm-2 control-label">Repetir Contraseña: </label>

                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="repetir_password" name="password" placeholder="Repetir Contraseña" required>
                        <span id=resultado_password class="help-block"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="niveles" class="col-sm-2 control-label">Permiso Nivel: </label>
                    
                      <div class="col-sm-10">
                        <select class="form-control select2" name="nivel" id="nivel-admin">
                          <option value="">--Seleccione Nivel--</option>
                          <option value="0">0</option>
                          <option value="1">1</option>
                        </select>
                      </div>  
                    </div>
                    
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                  <input type="hidden" name="registro" value="nuevo">
                    <button type="submit" class="btn btn-info pull-right" id="crear-registro-admin">Añadir</button>
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