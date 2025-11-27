<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

require_once "../config.inc.php";

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    exit(0);
}

$requestUri = $_SERVER['REQUEST_URI']; 
$parts = explode('/', $requestUri);
$userId = end($parts); 

if (!is_numeric($userId)) {
    echo json_encode(["success" => false, "message" => "ID do usuário inválido"]);
    exit;
}

$sqlCheck = mysqli_prepare($conexao, "SELECT id FROM users WHERE id = ?");
mysqli_stmt_bind_param($sqlCheck, "i", $userId);
mysqli_stmt_execute($sqlCheck);
$resultCheck = mysqli_stmt_get_result($sqlCheck);
$user = mysqli_fetch_assoc($resultCheck);

if (!$user) {
    echo json_encode(["success" => false, "message" => "Usuário não encontrado"]);
    exit;
}

$sqlDeleteReservations = mysqli_prepare($conexao, "DELETE FROM reservations WHERE user_id = ?");
mysqli_stmt_bind_param($sqlDeleteReservations, "i", $userId);
mysqli_stmt_execute($sqlDeleteReservations);
mysqli_stmt_close($sqlDeleteReservations);

$sqlDeleteUser = mysqli_prepare($conexao, "DELETE FROM users WHERE id = ?");
mysqli_stmt_bind_param($sqlDeleteUser, "i", $userId);

if (mysqli_stmt_execute($sqlDeleteUser)) {
    echo json_encode(["success" => true, "message" => "Usuário deletado com sucesso"]);
} else {
    echo json_encode(["success" => false, "message" => "Erro ao deletar usuário"]);
}

mysqli_stmt_close($sqlCheck);
mysqli_stmt_close($sqlDeleteUser);
mysqli_close($conexao);
?>
