<?php 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Credentials: true");
    require_once "config.inc.php";


    $input = json_decode(file_get_contents("php://input"), true);


    $name = $input['name'] ?? null;
    $email = $input['email'] ?? null;
    $password = $input['password'] ?? null;
    if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
        exit(0);
}

    if(empty($name) || empty($email) || empty($password)){
        echo json_encode(["error" => "Preencha todos os campos"]);
        exit;
    }
    $hash = password_hash($password, PASSWORD_BCRYPT);

    $sql = mysqli_prepare($conexao, 
    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
);
    mysqli_stmt_bind_param($sql, "sss", $name, $email, $hash);


    if(mysqli_stmt_execute($sql)){
    echo json_encode(["success" => true, "message" => "Usuário cadastrado"]);;
    }else{
    echo json_encode(["success" => false, "message" => "Erro ao cadastrar"]);
    }

    mysqli_stmt_close(statement: $sql);
    mysqli_close($conexao);

