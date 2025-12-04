<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "../backend/config.inc.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema - Página Inicial</title>
    <link rel="stylesheet" href="../css/pagina-principal.css">
</head>

<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">🎬 CINEMA PHPoltrona</a>

        <ul id="menu" class="navbar-nav">
            <li><a href="pagina-principal.php" class="nav-link">Início</a></li>
            <li><a href="user-reserva.php" class="nav-link">Minhas Reservas</a></li>
            <li><a href="../backend/logout.php" class="nav-link text-danger fw-bold">Sair</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="banner">
            <h1>Bem-vindo ao Melhor Cinema da Cidade 🎥</h1>
        </div>
    </div>

    <div class="container">
        <h2 class="mb-4">Sessões Disponíveis</h2>

        <?php 
        if (!isset($_SESSION['user_id'])) {
            echo "<p>Você precisa estar logado para entrar na sessão.</p>";
        } else {
            $sql = "SELECT id, start_time, end_time FROM sessions ORDER BY start_time ASC";
            $result = mysqli_query($conexao, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($session = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="session-card">
                        <p><strong>Sessão:</strong> <?= $session['id'] ?></p>
                        <p><strong>Início:</strong> <?= $session['start_time'] ?></p>
                        <p><strong>Término:</strong> <?= $session['end_time'] ?></p>
                        <form action="reserve.php" method="GET">
                            <input type="hidden" name="session_id" value="<?= $session['id'] ?>">
                            <button type="submit" class="btn-custom">Entrar na Sessão</button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Nenhuma sessão disponível no momento.</p>";
            }
        }
        ?>

    </div>

</body>
</html>

<?php
mysqli_close($conexao);
?>
