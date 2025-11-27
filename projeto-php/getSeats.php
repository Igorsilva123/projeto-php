<?php 
    include "auth.php";
    include "config.inc.php";
    header("Access-Control-Allow-Origin: http://localhost:4200");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: GET, PUT, POST, OPTIONS");
    header("Access-Control-Allow-Credentials: true");
    

    $sql = "SELECT * FROM seats";
    $result = mysqli_query($conexao, $sql);


    $seats = [];

    while($row = mysqli_fetch_assoc($result)){
        $seats[] = $row;
    }

    echo json_encode($seats);



?>