<?php
require_once "config.inc.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Método inválido");
}

$name     = $_POST['name'] ?? '';
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($name) || empty($email) || empty($password)) {
    die("Preencha todos os campos");
}

$hash = password_hash($password, PASSWORD_BCRYPT);

$sql = mysqli_prepare(
    $conexao,
    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
);

mysqli_stmt_bind_param($sql, "sss", $name, $email, $hash);

if (mysqli_stmt_execute($sql)) {

    header("Location: ../front/formulario-login.html");
    exit;
    
} else {
    echo "Erro ao cadastrar usuário.";
}

mysqli_stmt_close($sql);
mysqli_close($conexao);
?>
