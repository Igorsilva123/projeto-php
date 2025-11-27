<?php

    $conexao = mysqli_connect("localhost", "root", "", "projeto");

    $db = mysqli_select_db($conexao, "projeto");

    if(!$conexao){
        die("Erro ao se conectar: ". mysqli_connect_error());
    }



?>