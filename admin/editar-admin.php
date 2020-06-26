<?php
include 'funciones/sesiones.php';
include 'funciones/funciones.php';
$id = (int)$_GET['id'];
if (!filter_var($id, FILTER_VALIDATE_INT)) {
    die('Error!');
}
include_once 'templates/header.php';
include 'templates/barra.php';
include 'templates/navegacion.php';
?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Editar Administrador
            <small>llena el formulario para modificar a un administrador</small>
          </h1>
        </section>
        <div class="row">
          <div class="col-md-8">
        <!-- Main content -->
            <section class="content">
              <!-- Default box -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Administrador</h3>
                </div>
                <?php

                $sql = "SELECT * FROM admins WHERE id_admin = $id";
                $resultado = $conn->query($sql);
                $admin = $resultado->fetch_assoc();

                ?>
                <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-admin.php">
                  <div class="box-body">
                    <div class="form-group">

                      <label for="usuario" class="col-sm-2 control-label">Usuario: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo $admin['usuario']; ?>">
                      </div>

                    </div>
                    <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Nombre: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido" value="<?php echo $admin['nombre']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">Contraseña: </label>

                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="Password" class="col-sm-2 control-label">Repetir Contraseña: </label>

                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="repetir_password" name="repetir_password" placeholder="Repetir Contraseña">
                        <span id=resultado_password class="help-block"></span>
                      </div>  
                    </div>
                    <?php if ($_SESSION['nivel'] == 1) { ?>
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
                    <?php } ?>
                    
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_registro" value="<?php echo $id ?>">
                    <button type="submit" class="btn btn-info pull-right">Guardar</button>
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