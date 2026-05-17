<?php
require_once("dbConnection.php");

// Cargar opciones desde tus tablas reales
$vehiculos = mysqli_query($mysqli, "SELECT id_vehiculo, patente_placa, marca, modelo FROM vehiculo");
$personal  = mysqli_query($mysqli, "SELECT id_personal, nombre FROM personal_taller WHERE cargo = 'Mecánico'");
$servicios = mysqli_query($mysqli, "SELECT id_servicio, nombre_servicio, precio_base FROM servicio");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar al Historial</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .form-container { background: white; padding: 25px; border-radius: 8px; max-width: 500px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        select, input, textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-submit { background-color: #2ecc71; color: white; border: none; cursor: pointer; font-size: 16px; padding: 10px; margin-top: 10px; width: 100%; border-radius: 4px; }
        .btn-back { background-color: #95a5a6; color: white; text-decoration: none; padding: 10px; display: inline-block; text-align: center; margin-top: 10px; border-radius: 4px; width: 100%; box-sizing: border-box;}
    </style>
</head>
<body>

<div class="form-container">
    <h2>Registrar Servicio en Historial</h2>
    <form action="addAction.php" method="post">
        <div class="form-group">
            <label>Vehículo:</label>
            <select name="id_vehiculo" required>
                <option value="">-- Seleccione Vehículo --</option>
                <?php while($v = mysqli_fetch_assoc($vehiculos)) {
                    echo "<option value='{$v['id_vehiculo']}'>{$v['marca']} {$v['modelo']} [{$v['patente_placa']}]</option>";
                } ?>
            </select>
        </div>

        <!-- <div class="form-group">
            <label>Mecánico Asignado:</label>
            <select name="id_personal" required>
                <option value="">-- Seleccione Personal --</option>
                <?php while($p = mysqli_fetch_assoc($personal)) {
                    echo "<option value='{$p['id_personal']}'>{$p['nombre']}</option>";
                } ?>
            </select>
        </div> -->
		<div class="form-group">
            <label>ID Mecánico Asignado:</label>
            <input type="text" name="id_personal" placeholder="Ej: 3" required>
        </div>

        <div class="form-group">
            <label>Servicio Aplicado:</label>
            <select name="id_servicio" required>
                <option value="">-- Seleccione Servicio --</option>
                <?php while($s = mysqli_fetch_assoc($servicios)) {
                    echo "<option value='{$s['id_servicio']}'>{$s['nombre_servicio']} (\${$s['precio_base']})</option>";
                } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Fecha:</label>
            <input name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
        </div>

        <div class="form-group">
            <label>Observaciones del Mecánico:</label>
            <textarea name="observaciones" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>Costo Final ($):</label>
            <input type="number" step="0.01" name="costo_final" required>
        </div>

        <button type="submit" name="submit" class="btn-submit">Guardar Registro</button>
        <a href="index.php" class="btn-back">Volver al Listado</a>
    </form>
</div>

</body>
</html>