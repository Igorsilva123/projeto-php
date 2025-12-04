<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "config.inc.php";

if (!isset($_SESSION['user_id'])) {
    die("Você precisa estar logado para reservar.");
}

if (!isset($_POST['seat_id']) || !isset($_POST['session_id'])) {
    die("Dados incompletos para reservar.");
}

$seat_id = intval($_POST['seat_id']);
$session_id = intval($_POST['session_id']); 
$user_id = $_SESSION['user_id'];

$sqlCheck = "SELECT status FROM seats WHERE id = $seat_id AND session_id = $session_id";
$result = mysqli_query($conexao, $sqlCheck);
$seat = mysqli_fetch_assoc($result);

if (!$seat) {
    die("Cadeira não encontrada nesta sessão.");
}

if ($seat['status'] === "ocupado") {
    die("Esta cadeira já foi reservada.");
}
$sql = "UPDATE seats SET status='ocupado' WHERE id=$seat_id";
mysqli_query($conexao, $sql);

$sqlReserva = "INSERT INTO reservations (user_id, seat_id, session_id)
               VALUES ($user_id, $seat_id, $session_id)";
mysqli_query($conexao, $sqlReserva);

header("Location: ../front/user-reserva.php");
exit;
