<?php

    $conexao = mysqli_connect("localhost", "root", "", "projeto");

    $db = mysqli_select_db($conexao, "projeto");

    if(!$conexao){
        echo "<h2>Erro ao conectar o banco de dados</h2>";
    }
