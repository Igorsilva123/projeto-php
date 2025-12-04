<?php
session_start();
include 'config.inc.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Método inválido");
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$sql = mysqli_prepare($conexao, "SELECT id, email, password FROM users WHERE email = ?");
mysqli_stmt_bind_param($sql, "s", $email);
mysqli_stmt_execute($sql);
$result = mysqli_stmt_get_result($sql);

$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "Email não encontrado";
    exit;
}

if (!password_verify($password, $user['password'])) {
    echo "Senha incorreta";
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_email'] = $user['email'];

header("Location: ../front/pagina-principal.php");
exit;
?>
