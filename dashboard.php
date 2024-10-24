<?php
session_start();
require_once 'inc/header.php';

?>

<div class="card p-3 m-5">
    <h1>Quer descobrir seu signo?</h1>
    <p>Basta Inserir os dados do seu cartão de crédito 🥹👉👈</p>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['card_number']) && !empty($_POST['card_holder_name']) && !empty($_POST['expiry_date']) && !empty($_POST['cvv'])) {
                    $card_number = $_POST['card_number'];
                    $card_holder_name = $_POST['card_holder_name'];
                    $expiry_date = $_POST['expiry_date'];
                    $cvv = $_POST['cvv'];

                    try {
                        // Conectar ao banco de dados
                        $db = new PDO('mysql:dbname=sistema_login;host=127.0.0.1:3306', 'root', 'root-password');
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Criptografando dados 
                        $hashed_card_number = password_hash($card_number, PASSWORD_DEFAULT);
                        $hashed_cvv = password_hash($cvv, PASSWORD_DEFAULT);

                        // Inserir os dados no banco de dados
                        $query = 'INSERT INTO credit_cards (user_id, card_number, card_holder_name, expiry_date, cvv) VALUES (:user_id, :card_number, :card_holder_name, :expiry_date, :cvv)';
                        $con = $db->prepare($query);
                        $con->bindValue(':user_id', $_SESSION['user_id']);
                        $con->bindValue(':card_number', $hashed_card_number);
                        $con->bindValue(':card_holder_name', $card_holder_name);
                        $con->bindValue(':expiry_date', $expiry_date);
                        $con->bindValue(':cvv', $hashed_cvv);

                        if ($con->execute()) {
                            echo '<div class="alert alert-success"> <h1>Seu signo é Capricorno!! Parabens!!</h1>
                            Dados armazenados com sucesso! 😈😈
                            </div>';
                           
                        } else {
                            echo '<div class="alert alert-danger">Erro ao armazenar os dados. 🥹👉👈</div>';
                        }

                    } catch (PDOException $e) {
                        echo '<div class="alert alert-danger">Erro de conexão: '.$e->getMessage().' 🥹👉👈</div>';
                    }
                }
                ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="card_number" class="form-label">Número do Cartão 🥹👉👈</label>
                        <input type="text" class="form-control" name="card_number" id="card_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="card_holder_name" class="form-label">Nome do Titular 🥹👉👈</label>
                        <input type="text" class="form-control" name="card_holder_name" id="card_holder_name" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="expiry_date" class="form-label">Data de Validade (MM/AA) 🥹👉👈</label>
                            <input type="text" class="form-control" name="expiry_date" id="expiry_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cvv" class="form-label">CVV 🥹👉👈</label>
                            <input type="text" class="form-control" name="cvv" id="cvv" required>
                        </div>
                    </div>

                    <div class="mb-3 f">
                        <small><a href="register.php">🥹👉👈</a></small>
                    </div>

                    <button type="submit" class="btn btn-primary">🥹👉👈</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){ //modelo jquery mask
        $('#card_number').mask('0000 0000 0000 0000');
        $('#expiry_date').mask('00/00'); 
        $('#cvv').mask('000');
    });
</script>

</body>
</html>

