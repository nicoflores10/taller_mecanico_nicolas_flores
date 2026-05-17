<?php
require_once("dbConnection.php");

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($mysqli, $_POST['id']);
    $id_vehiculo = mysqli_real_escape_string($mysqli, $_POST['id_vehiculo']);
    $id_personal = mysqli_real_escape_string($mysqli, $_POST['id_personal']);
    $id_servicio = mysqli_real_escape_string($mysqli, $_POST['id_servicio']);
    $fecha = mysqli_real_escape_string($mysqli, $_POST['fecha']);
    $observaciones = mysqli_real_escape_string($mysqli, $_POST['observaciones']);
    $costo_final = mysqli_real_escape_string($mysqli, $_POST['costo_final']);

    if (empty($id_vehiculo) || empty($id_personal) || empty($id_servicio) || empty($fecha) || empty($costo_final)) {
        echo "<font color='red'>Campos obligatorios vacíos.</font><br/>";
    } else {
        $result = mysqli_query($mysqli, "UPDATE historial_servicio 
                                         SET id_vehiculo='$id_vehiculo', id_personal='$id_personal', id_servicio='$id_servicio', fecha='$fecha', observaciones='$observaciones', costo_final='$costo_final' 
                                         WHERE id_historial=$id");
        header("Location: index.php");
    }
}
?>