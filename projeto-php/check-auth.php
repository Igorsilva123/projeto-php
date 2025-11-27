<?php
include "auth.php";

header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");

if ($loggedUserID) {
    echo json_encode(["status" => "ok"]);
} else {
    http_response_code(401);
    echo json_encode(["status" => "erro"]);
}
