<?php
    $id = $_GET['id'];

    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die('Error');
    } else {
        include 'funciones/sesiones.php';
        include 'funciones/funciones.php';
        include_once 'templates/header.php';
        include 'templates/barra.php';
        include 'templates/navegacion.php'; ?>


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Editar Categoria de Eventos
            <small>llena el formulario para modificar un categoria</small>
          </h1>
        </section>
        <div class="row">
          <div class="col-md-8">
        <!-- Main content -->
            <section class="content">
              <!-- Default box -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Editar Categoria</h3>
                </div>
                <form class="form-horizontal reset" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-categoria.php">
                  <div class="box-body">
                  <?php
                  $sql = "SELECT * FROM categoria_evento WHERE id_categoria = $id";
                  $resultado = $conn->query($sql);
                  $categoria = $resultado->fetch_assoc(); 
                  ?>
                    <div class="form-group">
                      <label for="nombre_categoria" class="col-sm-2 control-label">Nombre Categoria: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Categoria" value="<?php echo $categoria['cat_evento']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="icono" class="col-sm-2 control-label">Icono: </label>

                      <div class="col-sm-10">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" class="form-control" id="icono" name="icono" placeholder="fa-icon" value="<?php echo $categoria['icono']; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id" value="<?php echo $categoria['id_categoria']; ?>">
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
     include 'templates/footer.php';
    }
     ?>