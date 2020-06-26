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
            Crear Registro de Usuario Manual
            <small>llena el formulario para crear un usuario registrado</small>
          </h1>
        </section>
        <div class="row">
          <div class="col-md-8">
        <!-- Main content -->
            <section class="content">
              <!-- Default box -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Crear Usuario</h3>
                </div>
                <form class="form-horizontal reset" name="guardar-registro" id="guardar-registro" method="POST" action="modelo-registrado.php">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Nombre: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="apellido" class="col-sm-2 control-label">Apellido: </label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email" class="col-sm-2 control-label">Correo Electrónico: </label>

                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="paquetes" id="paquetes">
                        <div class="box-header with-border">
                          <h3 class="box-title">
                            Elige el número de boletos
                          </h3>
                        </div>
                        <ul class="lista-precios row">
                          <li class="col-md-4">
                            <div class="tabla-precio text-center">
                              <h3>Pase por día (viernes)</h3>
                              <p class="numero">$30</p>
                              <ul>
                                <li>Bocadillos Gratis</li>
                                <li>Todas las Conferencias</li>
                                <li>Todos los talleres</li>
                              </ul>
                              <div class="orden">
                                <label for="pase_dia">Boletos deseados:</label>
                                <input class="form-control" type="number" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0">
                                <input type="hidden" value="30" name="boletos[un_dia][precio]">
                              </div>
                            </div>
                          </li>
                          <li class="col-md-4">
                            <div class="tabla-precio text-center">
                              <h3>Todos los días</h3>
                              <p class="numero">$50</p>
                              <ul>
                                <li>Bocadillos Gratis</li>
                                <li>Todas las Conferencias</li>
                                <li>Todos los talleres</li>
                              </ul>
                              <div class="orden">
                                <label for="pase_completo">Boletos deseados:</label>
                                <input class="form-control" type="number" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
                                <input type="hidden" value="50" name="boletos[completo][precio]">
                              </div>
                            </div>
                          </li>
                          <li class="col-md-4">
                            <div class="tabla-precio text-center">
                              <h3>Pase por 2 días (viernes y sabado)</h3>
                              <p class="numero">$45</p>
                              <ul>
                                <li>Bocadillos Gratis</li>
                                <li>Todas las Conferencias</li>
                                <li>Todos los talleres</li>
                              </ul>
                              <div class="orden">
                                <label for="pase_dosdias">Boletos deseados:</label>
                                <input class="form-control" type="number" min="0" id="pase_dosdias" size="3" name="boletos[2dias][cantidad]" placeholder="0">
                                <input type="hidden" value="45" name="boletos[2dias][precio]">
                              </div>
                              <!--.orden-->
                            </div>
                            <!--.tabla-precio-->
                          </li>
                        </ul>
                        <!--.precios-->
                      </div>
                      <!--Paquetes-->
                    </div><!-- FormGroup -->
                    <div class="form-group">
                      <div class="box-header with-border">
                        <h3 class="box-title">
                          Elige los talleres
                        </h3>
                      </div>
                      <div id="eventos" class="eventos">
                        <div class="caja">
                        <?php
                          try {
                              $sql ="SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado ";
                              $sql .= " FROM eventos ";
                              $sql .= " JOIN categoria_evento ";
                              $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                              $sql .= " JOIN invitados ";
                              $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                              $sql .= " ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento";
                    
                              $resultado = $conn->query($sql);
                          } catch (Exception $e) {
                              echo "Erro: " . $e->getMessage();
                          }
                          $eventos_dias = array();
                          while ($eventos = $resultado->fetch_assoc()) {
                              $fecha = $eventos['fecha_evento'];
                              setlocale(LC_ALL, 'es-ES');
                              $dia_semana = utf8_encode(strftime("%A", strtotime($fecha)));
                              $categoria = $eventos['cat_evento'];
                              
                              $dia = array(
                                "nombre_evento" => $eventos['nombre_evento'],
                                "hora" => date('h:i A', strtotime($eventos['hora_evento'])),
                                "id" => $eventos['evento_id'],
                                "nombre_invitado" => $eventos['nombre_invitado'], "apellido_invitado" => $eventos['apellido_invitado']
                              );
                              $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                          }
                        ?>
                        <?php foreach ($eventos_dias as $dia => $eventos) { ?>
                            
                      
                          <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia row">
                            <h4 class="text-center nombre_dia"><?php echo $dia; ?></h4>
                            <div class="evento-flex">
                              <?php foreach ($eventos['eventos'] as $tipo => $evento_dia) { ?>
                              <div class="col-md-4">
                                <p><?php echo $tipo ?>:</p>
                                <?php foreach ($evento_dia as $evento) { ?>
                                <label>
                                  <input type="checkbox" class="minimal" name="registro_evento[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>"><time><?php echo $evento['hora']; ?></time>
                                  <?php echo $evento['nombre_evento']; ?> - 
                                  <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></span>
                                </label> 
                                  <?php } ?>
                              </div>
                              <?php } ?>
                            </div>
                          </div>
                          <?php } ?><!--#viernes-->
                        </div>
                        <!--.caja-->
                      </div>
                      <!--#eventos-->

                      <div class="resumen" id="resumen">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                              Pagos y Extras
                            </h3>
                            <br>
                        </div>
                        <div class="caja row">
                          <div class="extras col-md-6">
                            <div class="orden">
                              <label for="camisa_evento">Camisa del evento $10 <small>(promoción 7% de dto.)</small></label>
                              <input class="form-control" type="number" min="0" id="camisa_evento" size="3" name="pedido_extra[camisas][cantidad]" placeholder="0">
                              <input type="hidden" name="pedido_extra[camisas][precio]"
                              value="10">
                            </div>
                            <!--Orden-->
                            <div class="orden">
                              <label for="etiquetas">Paquetes de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript,
                                  Chrome)</small></label>
                              <input class="form-control" type="number" min="0" id="etiquetas" size="3" name="pedido_extra[etiquetas][cantidad]" placeholder="0">
                              <input type="hidden" name="pedido_extra[etiquetas][precio]"
                              value="2">
                            </div>
                            <!--Orden-->
                            <div class="orden">
                              <label for="regalo">Seleccione un regalo</label>
                              <select id="regalo" class="form-control select2" name="regalo" required>
                                <option value="">-- Seleccione un regalo --</option>
                                <option value="2">Etiquetas</option>
                                <option value="1">Pulsera</option>
                                <option value="3">Plumas</option>

                              </select>
                              
                            </div>
                            <!--Orden-->
                            <div class="boton-calcular">
                              <br>
                              <input type="button" id="calcular" class="btn btn-success" value="Calcular">
                            </div>
                          </div>
                          <!--Extras-->
                          <div class="total col-md-6">
                            <p>Resumen:</p>
                            <div id="lista-productos">

                            </div>
                            <p>Total:</p>
                            <div id="suma-total">

                            </div>
                          </div>
                          <!--Total-->
                        </div>
                        <!--Caja-->
                      </div><!--#resumen -->
                    </div><!-- FormGroup -->
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <input type="hidden" name="total_pedido" id="total_pedido">
                    <input type="hidden" name="registro" value="nuevo">
                    <button type="submit" class="btn btn-info pull-right" id="btnRegistro">Añadir</button>
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