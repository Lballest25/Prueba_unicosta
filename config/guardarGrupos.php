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

$headers = array();
$headers[] = 'Authorization: JWT eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjo0LCJ1c2VybmFtZSI6InBydWViYTIwMjJAY3VjLmVkdS5jbyIsImV4cCI6MTY0OTQ1MzA1NCwiY29ycmVvIjoicHJ1ZWJhMjAyMkBjdWMuZWR1LmNvIn0.MAoFJE2SBgHvp9BS9fyBmb2gZzD0BHGPiyKoAo_uYAQ';
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
          $programa = $item['program'];
          $periodo = $item['term'];
          $codigo = $item['course_code'];
          $nombre = $item['course_name'];
          $modalidad = $item['modality'];
          $consultas->insertar_grupo($programa, $periodo, $codigo, $nombre, $modalidad);
        }
      }
      echo json_encode(array('mensaje' => 'Datos insertados correctamente'));
  }

curl_close($ch);
?>
