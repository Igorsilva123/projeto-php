<?php
require_once "config.inc.php";

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("ID do usuário não informado.");
}

$id = intval($_POST['id']); 

mysqli_query($conexao, "DELETE FROM reservations WHERE user_id = $id");

$result = mysqli_query($conexao, "DELETE FROM users WHERE id = $id");

if ($result) {
    header("Location: ../front/index-admin.php");
    exit;
} else {
    echo "<h2>Erro ao deletar usuário.</h2>";
    echo "<a href='../front/index-admin.php'>Voltar</a>";
}
?>
