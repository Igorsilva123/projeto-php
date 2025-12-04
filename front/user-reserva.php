<?php
session_start();
include "../backend/config.inc.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../front/formulario-login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "
    SELECT 
        r.id,
        u.name AS usuario,
        s.codigo AS cadeira,
        sess.id AS session_id,
        DATE_FORMAT(sess.start_time, '%H:%i') AS inicio_sessao,
        DATE_FORMAT(sess.end_time, '%H:%i') AS fim_sessao
    FROM reservations r
    JOIN users u ON r.user_id = u.id
    JOIN seats s ON r.seat_id = s.id
    JOIN sessions sess ON r.session_id = sess.id
    WHERE r.user_id = $user_id
    ORDER BY sess.start_time DESC
";

$result = mysqli_query($conexao, $sql);

if (!$result) {
    die("Erro no SQL: " . mysqli_error($conexao));
}
?>
<!DOCTYPE html>
<html lang='pt-br'>
<head>
<meta charset='UTF-8'>
<title>Minhas Reservas</title>
<style>
body {
    background: #121214;
    font-family: Arial;
    color: white;
}
table {
    width: 80%;
    margin: 30px auto;
    border-collapse: collapse;
    color: white;
}
th, td {
    border: 1px solid #444;
    padding: 12px;
    text-align: center;
}
th {
    background: #2d3250;
}

.back-btn {
    display: block;
    width: 200px;
    margin: 30px auto;
    padding: 12px;
    background-color: #f8b179;
    color: #121214;
    border-radius: 6px;
    text-align: center;
    font-weight: bold;
    text-decoration: none;
    transition: 0.2s;
}
.back-btn:hover {
    background-color: #d89260;
}
</style>
</head>
<body>

<h1 style="text-align:center;">Minhas Reservas</h1>

<table>
    <tr>
        <th>Usuário</th>
        <th>Cadeira</th>
        <th>Sessão</th>
        <th>Início</th>
        <th>Fim</th>
    </tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?= $row['usuario'] ?></td>
        <td><?= $row['cadeira'] ?></td>
        <td><?= $row['session_id'] ?></td>
        <td><?= $row['inicio_sessao'] ?></td>
        <td><?= $row['fim_sessao'] ?></td>
    </tr>
<?php } ?>

</table>

<a href="pagina-principal.php" class="back-btn">⬅ Voltar à Página Principal</a>

</body>
</html>
