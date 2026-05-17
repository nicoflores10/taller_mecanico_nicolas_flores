<?php
require_once("dbConnection.php");

// Consulta combinando las tablas implicadas en el historial
$query = "SELECT h.id_historial, h.fecha, h.observaciones, h.costo_final,
                 v.patente_placa, v.marca, v.modelo,
                 p.nombre AS nombre_personal,
                 s.nombre_servicio
          FROM historial_servicio h
          INNER JOIN vehiculo v ON h.id_vehiculo = v.id_vehiculo
          INNER JOIN personal_taller p ON h.id_personal = p.id_personal
          INNER JOIN servicio s ON h.id_servicio = s.id_servicio
          ORDER BY h.id_historial DESC";

$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Servicios - Taller Mecánico</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background-color: #f4f4f9; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #2c3e50; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; color: white; font-size: 14px; }
        .btn-add { background-color: #2ecc71; margin-bottom: 20px; display: inline-block; }
        .btn-edit { background-color: #3498db; margin-right: 5px; }
        .btn-delete { background-color: #e74c3c; }
    </style>
</head>
<body>

    <h2>Panel de Control: Historial de Servicios </h2>
    
    <a href="add.php" class="btn btn-add">Registrar Nuevo Servicio en Historial</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Vehículo</th>
                <th>Mecánico / Personal</th>
                <th>Servicio Realizado</th>
                <th>Observaciones</th>
                <th>Costo Final</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($res = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $res['id_historial']; ?></td>
                    <td><?php echo $res['fecha']; ?></td>
                    <td><?php echo $res['marca'] . " " . $res['modelo'] . " (" . $res['patente_placa'] . ")"; ?></td>
                    <td><?php echo $res['nombre_personal']; ?></td>
                    <td><?php echo $res['nombre_servicio']; ?></td>
                    <td><?php echo $res['observaciones']; ?></td>
                    <td>$<?php echo number_format($res['costo_final'], 2); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $res['id_historial']; ?>" class="btn btn-edit">Editar</a>
                        <a href="delete.php?id=<?php echo $res['id_historial']; ?>" class="btn btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este registro del historial?')">Eliminar</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>