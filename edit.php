<?php
require_once("dbConnection.php");

$id = mysqli_real_escape_string($mysqli, $_GET['id']);

$result = mysqli_query($mysqli, "SELECT * FROM historial_servicio WHERE id_historial = $id");
$resData = mysqli_fetch_assoc($result);

$id_vehiculo = $resData['id_vehiculo'];
$id_personal = $resData['id_personal'];
$id_servicio = $resData['id_servicio'];
$fecha = $resData['fecha'];
$observaciones = $resData['observaciones'];
$costo_final = $resData['costo_final'];

$vehiculos = mysqli_query($mysqli, "SELECT id_vehiculo, patente_placa, marca, modelo FROM vehiculo");
$personal  = mysqli_query($mysqli, "SELECT id_personal, nombre FROM personal_taller WHERE cargo = 'Mecánico'");
$servicios = mysqli_query($mysqli, "SELECT id_servicio, nombre_servicio FROM servicio");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Historial</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .form-container { background: white; padding: 25px; border-radius: 8px; max-width: 500px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        select, input, textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-submit { background-color: #3498db; color: white; border: none; cursor: pointer; font-size: 16px; padding: 10px; margin-top: 10px; width: 100%; border-radius: 4px; }
        .btn-back { background-color: #95a5a6; color: white; text-decoration: none; padding: 10px; display: inline-block; text-align: center; margin-top: 10px; border-radius: 4px; width: 100%; box-sizing: border-box;}
    </style>
</head>
<body>

<div class="form-container">
    <h2>Editar Historial Nº <?php echo $id; ?></h2>
    <form action="editAction.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
            <label>Vehículo:</label>
            <select name="id_vehiculo" required>
                <?php while($v = mysqli_fetch_assoc($vehiculos)) {
                    $selected = ($v['id_vehiculo'] == $id_vehiculo) ? "selected" : "";
                    echo "<option value='{$v['id_vehiculo']}' {$selected}>{$v['marca']} {$v['modelo']} [{$v['patente_placa']}]</option>";
                } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Mecánico:</label>
            <select name="id_personal" required>
                <?php while($p = mysqli_fetch_assoc($personal)) {
                    $selected = ($p['id_personal'] == $id_personal) ? "selected" : "";
                    echo "<option value='{$p['id_personal']}' {$selected}>{$p['nombre']}</option>";
                } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Servicio Aplicado:</label>
            <select name="id_servicio" required>
                <?php while($s = mysqli_fetch_assoc($servicios)) {
                    $selected = ($s['id_servicio'] == $id_servicio) ? "selected" : "";
                    echo "<option value='{$s['id_servicio']}' {$selected}>{$s['nombre_servicio']}</option>";
                } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Fecha:</label>
            <input type="date" name="fecha" value="<?php echo $fecha; ?>" required>
        </div>

        <div class="form-group">
            <label>Observaciones:</label>
            <textarea name="observaciones" rows="3"><?php echo $observaciones; ?></textarea>
        </div>

        <div class="form-group">
            <label>Costo Final ($):</label>
            <input type="number" step="0.01" name="costo_final" value="<?php echo $costo_final; ?>" required>
        </div>

        <button type="submit" name="update" class="btn-submit">Actualizar Cambios</button>
        <a href="index.php" class="btn-back">Cancelar</a>
    </form>
</div>

</body>
</html>