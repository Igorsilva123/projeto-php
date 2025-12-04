<?php
require_once "../backend/config.inc.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conexao, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("Usuário não encontrado.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Editar Usuário</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light p-5">

<div class="container">
    <h2 class="mb-4">Editar Usuário</h2>

    <form action="../backend/update-user.php" method="POST" class="card p-4 bg-secondary">

        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
        </div>

        <button class="btn btn-warning">Salvar Alterações</button>
        <a href="index-admin.php" class="btn btn-light ms-2">Cancelar</a>
    </form>
</div>

</body>
</html>
