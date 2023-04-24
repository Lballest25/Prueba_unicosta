<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Prueba</title>
</head>
<body>

<div class="contenedorMenu">
<ul>
    <li><a href="estudiantes.php">Estudiantes</a></li>
    <li><a href="gruEstudiantes.php">Informacion completa</a></li>
    <li><a href="notas.php">Gestionar notas</a></li>
</ul>
</div>

<div class="contenedorBoton">
    <button onclick="consultaApi()">Guardar</button>
</div>

<div class="contenedorTabla">
<table>
    <thead>
        <tr>
            <th>Programa</th>
            <th>Periodo</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Modalidad</th>
        </tr>
    </thead>
    <tbody id="tablaGrupos">
        
    </tbody>
</table>
</div>
<script src="js/app.js"></script>
<script src="js/jsGrupos.js"></script>
</body>
</html>