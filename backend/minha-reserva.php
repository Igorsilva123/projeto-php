<?php
session_start();
include "config.inc.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../formulario-login.php");
    exit;
}

$usuarioLogado = $_SESSION['user_id'];

$sql = "SELECT 
        r.id,
        u.name AS usuario,
        s.codigo AS cadeira,
        r.data_reserva
        FROM reservations r
        LEFT JOIN users u ON r.user_id = u.id
        LEFT JOIN seats s ON r.seat_id = s.id
        WHERE r.user_id = $usuarioLogado
        ORDER BY r.data_reserva DESC";

$result = mysqli_query($conexao, $sql);
?>
