<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "config.inc.php";

if (!isset($_SESSION['user_id'])) {
    die("Você precisa estar logado para acessar a sessão.");
}

$sql = "SELECT id, start_time, end_time FROM sessions LIMIT 1";
$result = mysqli_query($conexao, $sql);

if (!$result) {
    die("Erro ao buscar a sessão: " . mysqli_error($conexao));
}

$session = mysqli_fetch_assoc($result);

if (!$session) {
    echo "Nenhuma sessão disponível no momento.";
    exit;
}
?>
