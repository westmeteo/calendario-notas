<?php
/*
  Endpoint de sincronización para "Calendario de Notas".
  Sube este archivo a tu Hostinger (misma carpeta que calendario_notas.html).
  - GET  sync.php?key=CLAVE        -> devuelve el JSON guardado (o "null")
  - POST sync.php?key=CLAVE  body=JSON -> guarda el JSON
  La CLAVE actúa como contraseña del espacio: usa una larga y la misma en PC y móvil.
*/

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") { http_response_code(204); exit; }

$key = isset($_GET["key"]) ? $_GET["key"] : "";
if (!preg_match('/^[A-Za-z0-9_-]{6,64}$/', $key)) {
    http_response_code(400);
    header("Content-Type: application/json");
    echo json_encode(array("error" => "clave invalida (6-64 caracteres: letras, numeros, _ o -)"));
    exit;
}

$dir = __DIR__ . "/cal_data";
if (!is_dir($dir)) {
    @mkdir($dir, 0700);
    @file_put_contents($dir . "/.htaccess", "Require all denied\nDeny from all\n");
    @file_put_contents($dir . "/index.html", "");
}
$file = $dir . "/" . $key . ".json";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $body = file_get_contents("php://input");
    if (strlen($body) > 10000000) {
        http_response_code(413);
        header("Content-Type: application/json");
        echo json_encode(array("error" => "demasiado grande"));
        exit;
    }
    $data = json_decode($body, true);
    if ($data === null && trim($body) !== "null") {
        http_response_code(400);
        header("Content-Type: application/json");
        echo json_encode(array("error" => "JSON invalido"));
        exit;
    }
    file_put_contents($file, $body, LOCK_EX);
    header("Content-Type: application/json");
    echo json_encode(array("ok" => true));
    exit;
}

// GET
header("Content-Type: application/json");
if (is_file($file)) {
    echo file_get_contents($file);
} else {
    echo "null";
}
