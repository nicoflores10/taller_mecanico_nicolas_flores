<?php
require_once("dbConnection.php");

$id = mysqli_real_escape_string($mysqli, $_GET['id']);

$result = mysqli_query($mysqli, "DELETE FROM historial_servicio WHERE id_historial = $id");

header("Location:index.php");
?>
