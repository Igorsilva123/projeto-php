
<?php
    if(empty($_SERVER["QUERY_STRING"])){
        $var = "user-register";
        include_once "$var.php";
    }elseif($_GET['pg']){
        $pg = $_GET['pg'];
        include_once "$pg.php";
    }else{
        echo "Página não encontrada";
    }


?>