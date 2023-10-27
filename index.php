<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "conexion.php";
require "auxiliar.php";

$consulta = "SELECT id, fecha_comunicacion, fecha_inicio, fecha_fin, posicion, direccion, coordenada, asunto, tipo, solucionado, estado, foto_inicio, foto_fin FROM Limpiezas";
$resultado = pg_query($con, $consulta);

if (!$resultado) {
    die("Error en la consulta: " . pg_last_error());
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index_limpieza.css">
    <title>Bienvenido</title>
</head>

<body>

<div class="inicio">
    <ul> 
        <li><a href="index.php">Inicio</a></li>
    </ul>

    <ul> 
        <li><a>Contacto</a></li>
    </ul>
</div>

<div class="container"> 
    <table border='1'>
        <tr>
            <th>ID</th>
            <th>Fecha Comunicación</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Posición</th>
            <th>Dirección</th>
            <th>Coordenada</th>
            <th>Asunto</th>
            <th>Tipo</th>
            <th>Solucionado</th>
            <th>Estado</th>
            <th>Fotos Inicio</th>
            <th>Fotos Fin</th>
        </tr>

        <?php
        while ($fila = pg_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $fila['id'] . "</td>";
            echo "<td>" . $fila['fecha_comunicacion'] . "</td>";
            echo "<td>" . $fila['fecha_inicio'] . "</td>";
            echo "<td>" . $fila['fecha_fin'] . "</td>";
            echo "<td>" . $fila['posicion'] . "</td>";
            echo "<td>" . $fila['direccion'] . "</td>";
            echo "<td><a href='https://www.google.com/maps/place/{$fila['coordenada']}' target='_blank'>{$fila['coordenada']}</a></td>";
            echo "<td>" . $fila['asunto'] . "</td>";
            echo "<td>" . $fila['tipo'] . "</td>";
            echo "<td>" . $fila['solucionado'] . "</td>";
            echo "<td>" . $fila['estado'] . "</td>";
            echo "<td><a href='{$fila['foto_inicio']}' target='_blank'><img src='{$fila['foto_inicio']}' alt='Foto Inicio' width='100'></a></td>";
            echo "<td><a href='{$fila['foto_fin']}' target='_blank'><img src='{$fila['foto_fin']}' alt='Foto Fin' width='100'></a></td>";
             
        }
        pg_close($con);
        ?>
    </table>
</div>

<a href="nuevo_registro.php" class="boton-nuevo-registro">Nuevo Registro</a>


</body>
</html>
