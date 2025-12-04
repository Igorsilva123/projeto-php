<?php
require_once "config.inc.php";

if (!isset($_POST['id']) || empty($_POST['id'])) {
    die("ID do usuário não informado.");
}

if (!isset($_POST['name']) || !isset($_POST['email'])) {
    die("Nome ou email não enviados.");
}

$id = intval($_POST['id']);
$name = trim($_POST['name']);
$email = trim($_POST['email']);

$sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";

$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "ssi", $name, $email, $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../front/index-admin.php?msg=editado");
    exit;
} else {
    echo "<a href='../front/index-admin.php'>Voltar</a>";
}

mysqli_stmt_close($stmt);
mysqli_close($conexao);
