<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");

include_once "config.inc.php";

if (!isset($_COOKIE['auth_token'])) {
    http_response_code(401);
    echo json_encode(["error" => "Não autorizado. Nenhum cookie encontrado."]);
    exit;
}

$token = $_COOKIE['auth_token'];

$sql = mysqli_prepare($conexao, "SELECT id, email FROM users WHERE token = ?");
mysqli_stmt_bind_param($sql, "s", $token);
mysqli_stmt_execute($sql);
$result = mysqli_stmt_get_result($sql);

$user = mysqli_fetch_assoc($result);

if (!$user) {
    http_response_code(401);
    echo json_encode(["error" => "Token inválido ou expirado."]);
    exit;
}

$AUTH_USER_ID = $user['id'];
$AUTH_USER_EMAIL = $user['email'];
?>
