<?php
$databaseHost = 'sql207.infinityfree.com';
$databaseName = 'if0_41946674_XXX';
$databaseUsername = 'if0_41946674';
$databasePassword = 'huguito25051810';

// Conexión usando mysqli_connect (como el archivo del profesor)
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

if (!$mysqli) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>