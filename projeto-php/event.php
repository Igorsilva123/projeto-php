<?php


    $seats = $input['seats'] ?? null;
    $amount = $input['amount'] ?? null;
    $name = $ $input['name'] ?? null;

    $sql = mysqli_prepare($conexao, "SELECT id, email, password FROM users WHERE email = ?");
    mysqli_stmt_bind_param($sql, "s", $email);
    mysqli_stmt_execute($sql);
?>