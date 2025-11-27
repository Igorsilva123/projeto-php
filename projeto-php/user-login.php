<?php
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

include 'config.inc.php';

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

$sql = mysqli_prepare($conexao, "SELECT id, email, password FROM users WHERE email = ?");
mysqli_stmt_bind_param($sql, "s", $email);
mysqli_stmt_execute($sql);
$result = mysqli_stmt_get_result($sql);

$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo json_encode(["error" => "Email não encontrado"]);
    exit;
}

if (!password_verify($password, $user['password'])) {
    echo json_encode(["error" => "Senha incorreta"]);
    exit;
}

$token = bin2hex(random_bytes(32));

$sqlToken = mysqli_prepare($conexao, "UPDATE users SET token = ? WHERE id = ?");
mysqli_stmt_bind_param($sqlToken, "si", $token, $user['id']);
mysqli_stmt_execute($sqlToken);

setcookie(
    "auth_token",    
    $token,             
    time() + (60*60*24), 
    "/",               
    "",                 
    false,              
    true             
);

echo json_encode([
    "message" => "Login realizado com sucesso!",
    "user_id" => $user['id']
]);
?>
