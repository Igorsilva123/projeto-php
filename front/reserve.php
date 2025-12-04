<?php  
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../backend/config.inc.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: formulario-login.html");
    exit();
}

if (!isset($_GET['session_id'])) {
    die("Sessão não informada.");
}

$session_id = intval($_GET['session_id']);

$sql = "SELECT * FROM seats WHERE session_id = $session_id ORDER BY id ASC";
$result = mysqli_query($conexao, $sql);

if (!$result) {
    die("Erro no SQL: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="../css/reserve.css">
<title>Selecionar Assento</title>
</head>
<body>

<div class="container">
    <div class="screen">TELA</div>

    <form method="POST" action="../backend/reserve-seat.php" id="seatForm">
        
        <div class="seat-grid">
            <?php  
           while ($seat = mysqli_fetch_assoc($result)) {
                $id = $seat['id'];
                $codigo = $seat['codigo']; 
                $status = $seat['status'];
                $class = $status == "livre" ? "livre" : "ocupado";
                $disabled = $status == "ocupado" ? "disabled" : "";
                
                echo "<button type='button' class='seat-btn $class' data-id='$id' $disabled>$codigo</button>";
            }

            ?>
        </div>

        <input type="hidden" name="seat_id" id="seat_id">
        <input type="hidden" name="session_id" value="<?php echo $session_id; ?>">

        <button type="submit" class="btn-confirm">Confirmar Cadeira</button>
    </form>
</div>

<script>
const seats = document.querySelectorAll('.seat-btn');
let selectedSeat = null;

seats.forEach(seat => {
    seat.addEventListener('click', () => {
        if(seat.classList.contains('ocupado')) return;

        if(seat.classList.contains('selected')) {
            seat.classList.remove('selected');
            selectedSeat = null;
            document.getElementById('seat_id').value = '';
            return;
        }

        if(selectedSeat) selectedSeat.classList.remove('selected');

        seat.classList.add('selected');
        selectedSeat = seat;

        document.getElementById('seat_id').value = seat.getAttribute('data-id');
    });
});
</script>

</body>
</html>
