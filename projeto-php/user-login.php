<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include 'config.inc.php';

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$password = $data['password'];

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
    echo json_encode([
        "message" => "Login realizado com sucesso!"])
        


?>
