<?php
session_start();
include "../backend/config.inc.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: user-login-admin.html"); 
    exit();
}

$sql = "SELECT * FROM users ORDER BY id ASC";
$result = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/index-admin.css">
</head>

<body>

    <div class="sidebar">
        <a href="#" class="active" id="link-users">Usuários</a>

        <form action="../backend/logout-admin.php" method="POST">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="main-content">
        <h2>Usuários</h2>
        <p>Lista de Usuarios Cadastrados</p>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <form method="GET" action="./edit-user.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <button type="submit" class="btn-warning">Atualizar</button>
                                </form>

                                <form method="POST" action="../backend/delete-user.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <button type="submit" class="btn-delete">Excluir</button>
                            
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
