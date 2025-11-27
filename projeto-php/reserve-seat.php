<?php
include "auth.php"; 
$user_id = $AUTH_USER_ID;
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Content-Type: application/json"); 

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    echo json_encode(["status" => "erro", "msg" => "Método inválido"]);
    exit;
}

include "config.inc.php";

$data = json_decode(file_get_contents("php://input"), true);
$seat_id = $data['seat_id'] ?? null; 

if (!$seat_id) {
    echo json_encode(["status" => "erro", "msg" => "ID da cadeira obrigatório"]);
    exit;
}

$sql = "UPDATE seats 
        SET status='ocupado'
        WHERE id='$seat_id' AND status='livre'";

if (mysqli_query($conexao, $sql)) {

    if (mysqli_affected_rows($conexao) > 0) {

        $sql2 = "INSERT INTO reservations (user_id, seat_id, data_reserva)
                 VALUES ('$user_id', '$seat_id', NOW())";

        if (mysqli_query($conexao, $sql2)) {
            echo json_encode(["status" => "sua cadeira foi reservada"]);
        } else {
            echo json_encode(["status" => "erro", "msg" => "Falha ao criar reserva"]);
        }

    } else {
        echo json_encode(["status" => "erro", "msg" => "Cadeira já ocupada"]);
    }

} else {
    echo json_encode(["status" => "erro", "msg" => "Erro ao atualizar cadeira"]);
}
