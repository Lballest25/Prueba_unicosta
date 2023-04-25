<?php
require_once "../config/conexion.php";
require_once "../modelo/modeloConsultas.php";
$tipo_consulta = $_GET['tipo_operacion'];
switch ($tipo_consulta) {
    case 'seleccionarGrupos':
        $consultas = new consultas();
        $ejecutar = $consultas->select_grupos();
        echo json_encode($ejecutar);
        break;
    
    case 'seleccionarEstudiantes':
        $consultas = new consultas();
        $ejecutar = $consultas->select_estudiantes();
        echo json_encode($ejecutar);
        break;
    
    case 'seleccionarTodo':
        $consultas = new consultas();
        $ejecutar = $consultas->select_gruEstudiante();
        echo json_encode($ejecutar);
        break;

    case 'obtenerNotas':
        $consultas = new consultas();
        $ejecutar = $consultas->obtener_notasEstudiantes();
        echo json_encode($ejecutar);
        break;
        
    case 'insertarNotas':
        $identificacion = $_POST['identificacion'];
        $nota1 = $_POST['nota1'];
        $nota2 = $_POST['nota2'];
        $nota3 = $_POST['nota3'];
        $consultas = new consultas();
        $ejecutar = $consultas->insertar_notas($identificacion, $nota1, $nota2, $nota3);
        echo json_encode($ejecutar);
        break;

    case 'editarNotas':
        $identificacion = $_POST['id'];
        $consultas = new consultas();
        $ejecutar = $consultas->obtener_notasEstudiante($identificacion);
        echo json_encode($ejecutar);
        break;

    case 'actualizarNotas':
        $identificacion = $_POST['identificacionA'];
        $nota1 = $_POST['nota1A'];
        $nota2 = $_POST['nota2A'];
        $nota3 = $_POST['nota3A'];
        $consultas = new consultas();
        $ejecutar = $consultas->actualizar_notas($identificacion, $nota1, $nota2, $nota3);
        echo json_encode($ejecutar);
        break;

    case 'calcularNota':
        $identificacion = $_POST['id'];
        $consultas = new consultas();
        $ejecutar = $consultas->calcular_nota($identificacion);
        echo json_encode($ejecutar);
        break;

    default:
        # code...
        break;
}
?>