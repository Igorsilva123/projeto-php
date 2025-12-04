<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }   


    $conexao = mysqli_connect("localhost", "root", "", "teste");

    $db = mysqli_select_db($conexao, "teste");

    if(!$conexao){
        die("Erro ao se conectar: ". mysqli_connect_error());
    }



?>