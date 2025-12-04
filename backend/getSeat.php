<?php
session_start();
include "config.inc.php";

if (!isset($_SESSION['user_id'])) {
    die("Você precisa estar logado para ver as cadeiras.");
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conexao, "SELECT * FROM seats ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cadeiras do Cinema</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .seat {
            width: 65px;
            height: 65px;
            margin: 6px;
            font-weight: bold;
            border-radius: 10px;
            border: none;
            color: white;
        }
        .livre { background: #4CAF50; }
        .ocupado { background: #d9534f; }
        .my-seat { background: #0D6EFD; }
        .screen {
            width: 100%;
            padding: 12px;
            background: #ddd;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">Mapa de Cadeiras</h2>
    <div class="screen">TELA</div>

    <div class="d-flex flex-wrap">

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <?php 
            $classe = $row['status'];

            if ($row['user_id'] == $user_id) {
                $classe = "my-seat";
            }
            ?>

            <?php if ($row['status'] === "livre") { ?>

                <form action="reserve-seat.php" method="POST" class="m-1">
                    <input type="hidden" name="seat_id" value="<?= $row['id'] ?>">
                    <button class="seat livre" type="submit">
                        <?= $row['codigo'] ?>
                    </button>
                </form>

            <?php } else { ?>

                <button class="seat <?= $classe ?>" disabled>
                    <?= $row['codigo'] ?>
                </button>

            <?php } ?>

        <?php } ?>

    </div>
</div>

</body>
</html>
