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
    <li><a href="grupos.php">Grupos</a></li>
    <li><a href="gruEstudiantes.php">Informacion completa</a></li>
    <li><a href="notas.php">Gestionar notas</a></li>
</ul>
</div>

<div class="contenedorBoton">
    <button type="submit">Guardar</button>
</div>

<div class="contenedorTabla">
    <table>
    <thead>
        <tr>
            <th>curso</th>
            <th>identificacion</th>
            <th>nombres</th>
            <th>apellidos</th>
            <th>correo</th>
        </tr>
    </thead>
    <tbody id="tablaEstudiantes">
        
    </tbody>
</table>
</div>
<script src="js/app.js"></script>
<script src="js/jsEstudiantes.js"></script>
</body>
</html>