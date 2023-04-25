<?php
// Código del grupo que deseas consultar
$grupo = 'G001';

// URL de la API
$url = 'http://consultas.cuc.edu.co/api/v1.0/estudiantes';

// Token JWT
$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjo0LCJ1c2VybmFtZSI6InBydWViYTIwMjJAY3VjLmVkdS5jbyIsImV4cCI6MTY0OTQ1MzA1NCwiY29ycmVvIjoicHJ1ZWJhMjAyMkBjdWMuZWR1LmNvIn0.MAoFJE2SBgHvp9BS9fyBmb2gZzD0BHGPiyKoAo_uYAQ';

// Datos en formato JSON que se enviarán en la solicitud
$data = array('course' => $grupo);
$data_string = json_encode($data);

// Configuración de la solicitud HTTP POST
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string),
    'Authorization: Bearer ' . $token
));

// Ejecución de la solicitud y obtención de la respuesta
$response = curl_exec($ch);

// Verificación de errores
if (curl_errno($ch)) {
  echo 'Error al consumir la API: ' . curl_error($ch);
} else {
  // Decodificación de la respuesta JSON
  $estudiantes = json_decode($response, true);
  
  // Almacenamiento de los datos en la base de datos
  // (aquí deberías insertar los datos en la tabla correspondiente)
  require_once "../config/conexion.php";
  require_once "../modelo/modeloConsultas.php";
  
  if (isset($estudiantes['data'])) {
    foreach ($estudiantes['data'] as $estudiante) {
      $curso = $estudiante['course'];
      $identificacion = $estudiante['identification'];
      $nombres = $estudiante['names'];
      $apellidos = $estudiante['last_names'];
      $correo = $estudiante['email'];

      // Insertar los datos en la base de datos
      $consultas = new consultas();
      $consultas->insertar_estudiante($curso, $identificacion, $nombres, $apellidos, $correo);
    }
  }

  // Respuesta para el cliente (puede ser opcional)
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  echo json_encode(array('status' => 'OK'));
}

curl_close($ch);
?>