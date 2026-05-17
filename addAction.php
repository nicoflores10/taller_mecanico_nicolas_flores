<?php
require_once("dbConnection.php");

if (isset($_POST['submit'])) {
    // Sanitización clásica como en el archivo original del profesor
    $id_vehiculo = mysqli_real_escape_string($mysqli, $_POST['id_vehiculo']);
    $id_personal = mysqli_real_escape_string($mysqli, $_POST['id_personal']);
    $id_servicio = mysqli_real_escape_string($mysqli, $_POST['id_servicio']);
    $fecha = mysqli_real_escape_string($mysqli, $_POST['fecha']);
    $observaciones = mysqli_real_escape_string($mysqli, $_POST['observaciones']);
    $costo_final = mysqli_real_escape_string($mysqli, $_POST['costo_final']);

    if (empty($id_vehiculo) || empty($id_personal) || empty($id_servicio) || empty($fecha) || empty($costo_final)) {
        echo "<font color='red'>Por favor rellene los campos obligatorios.</font><br/>";
        echo "<a href='javascript:self.history.back();'>Volver</a>";
    } else {
        $result = mysqli_query($mysqli, "INSERT INTO historial_servicio (id_vehiculo, id_personal, id_servicio, fecha, observaciones, costo_final) 
                                         VALUES ('$id_vehiculo', '$id_personal', '$id_servicio', '$fecha', '$observaciones', '$costo_final')");
        
        header("Location: index.php");
    }
}
?>