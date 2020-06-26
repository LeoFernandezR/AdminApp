<?php
error_reporting(E_ALL ^ E_NOTICE);
if ($_POST['registro'] == 'nuevo') {
    $titulo = $_POST['titulo_evento'];
    $categoria = $_POST['categoria_evento'];
    $invitado = $_POST['invitado_evento'];
    //fecha evento
    $fecha = $_POST['fecha_evento'];
    $fecha_formateada = date('Y-m-d', strtotime($fecha));
    $hora = $_POST['hora_evento'];
    $hora_formato = date('H:i', strtotime($hora));
    try {
        include 'funciones/funciones.php';
        $stmt = $conn->prepare('INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_inv) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssii', $titulo, $fecha_formateada, $hora_formato, $categoria, $invitado);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
};
if ($_POST['registro'] == 'actualizar') {
    $titulo = $_POST['titulo_evento'];
    $categoria = $_POST['categoria_evento'];
    $invitado = $_POST['invitado_evento'];
    //fecha evento
    $fecha = $_POST['fecha_evento'];
    $fecha_formateada = date('Y-m-d', strtotime($fecha));
    $hora = $_POST['hora_evento'];
    $id = $_POST['id'];
    $hora_formato = date('H:i', strtotime($hora));

    include 'funciones/funciones.php';

    try {
        $stmt = $conn->prepare('UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento, id_cat_evento = ?, id_inv = ?, editado = NOW() WHERE evento_id = ?');
        $stmt->bind_param('sssiii', $titulo, $fecha_formateada, $hora_formato, $categoria, $invitado, $id);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $stmt-> $id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}
if ($_POST['registro'] == 'eliminar') {
    $id_borrar = $_POST['id'];
    try {
        include 'funciones/funciones.php';
        $stmt =$conn->prepare('DELETE FROM eventos WHERE evento_id = ?');
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}
