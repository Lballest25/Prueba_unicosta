<?php

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
  header('Access-Control-Allow-Headers: Content-Type, Authorization');
  header('Access-Control-Max-Age: 86400');
  exit();
}

$url = 'http://consultas.cuc.edu.co/api/v1.0/grupos';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjo0LCJ1c2VybmFtZSI6InBydWViYTIwMjJAY3VjLmVkdS5jbyIsImV4cCI6MTY0OTQ1MzA1NCwiY29ycmVvIjoicHJ1ZWJhMjAyMkBjdWMuZWR1LmNvIn0.MAoFJE2SBgHvp9BS9fyBmb2gZzD0BHGPiyKoAo_uYAQ';
$headers = array();
$headers[] = 'Authorization: JWT '.$token;
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);

if (curl_errno($ch)) {
  echo 'Error al consumir la API: ' . curl_error($ch);
} else {
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  require_once "../config/conexion.php";
  require_once "../modelo/modeloConsultas.php";
  $data = json_decode($response, true);
  $consultas = new consultas();
  if ($data && is_array($data)) {
    foreach ($data as $item) {
      $curso = $item['course_code'];
      $url_estudiantes = 'http://consultas.cuc.edu.co/api/v1.0/estudiantes';
      $data = array('course' => $curso);
      $options = array(
        'http' => array(
          'header'  => "Content-type: application/json\r\n" .
                       "Authorization: JWT " . $token . "\r\n",
          'method'  => 'POST',
          'content' => json_encode($data),
        ),
      );
      $context  = stream_context_create($options);
      $result = file_get_contents($url_estudiantes, false, $context);
      $result = json_decode($result, true);
      if ($result && is_array($result)) {
        foreach ($result as $key) {
          $curso = $key['course'];
          $identificacion = $key['student'];
          $nombres = $key['names'];
          $apellidos = $key['last_names'];
          $correo = $key['email'];
          $consultas->insertar_estudiante($curso, $identificacion, $nombres, $apellidos, $correo);
        }
      }
    }
    echo json_encode(array('mensaje' => 'Datos insertados correctamente'));
  }
}

curl_close($ch);

?>