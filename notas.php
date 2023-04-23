<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Document</title>
</head>
<body>

<div class="contenedorMenu">
<ul>
    <li><a href="grupos.php">Grupos</a></li>
    <li><a href="estudiantes.php">Estudiantes</a></li>
    <li><a href="gruEstudiantes.php">Informacion completa</a></li>
</ul>
</div>

<div class="contenedorCrudNotas">
<div class="contenedorFormCrear">
<h2>Crear nota</h2>
	<form id="form">
    <label for="nota1">Nota 1:</label>
    <input type="number" name="nota1" id="nota1" min="0" max="5" required>
    <br><br>
    <label for="nota2">Nota 2:</label>
    <input type="number" name="nota2" id="nota2" min="0" max="5" required>
    <br><br>
    <label for="nota3">Nota 3:</label>
    <input type="number" name="nota3" id="nota3" min="0" max="5" required>
    <br><br>
    <input type="hidden" name="identificacion" id="identificacion">
	<button type="submit">Guardar notas</button>
	</form>
</div>

<div class="contenedorTabla">
    <table>
        <thead>
            <tr>
                <th>Identificacion</th>
                <th>Nota 1</th>
                <th>Nota 2</th>
                <th>Nota 3</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaCrudNotas">
        <tr>
                <td>1234</d>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td><button>Editar</button></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
    <script src="js/app.js"></script>
    <script src="js/jsCrudNotas.js"></script>
</body>
</html>