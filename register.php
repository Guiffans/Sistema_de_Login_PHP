<?php
session_start();
require_once 'inc/header.php';

?>

<div class="container">
    
    <div class="card p-3 m-5">
    <h1>Registre-se</h1>
        <div class="card-body">

            <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['cpf']) && !empty($_POST['password']) && !empty($_POST['passwordconfirm'])) {
                    $cpf = $_POST['cpf'];
                    $password = $_POST['password']; 
                    $passwordconfirm = $_POST['passwordconfirm'];
                    $dateNow = strtotime("now");
                    $createdDate = date('Y-m-d H:i:s', $dateNow);

                     

                    //verificacao da senha
                    if ($password === $passwordconfirm) {
                        
                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                        // conecta com o banco
                        $db = new PDO('mysql:dbname=sistema_login;host=127.0.0.1:3306', 'root', 'root-password');
                        $query = 'INSERT INTO users (cpf, password, create_date) VALUES (:cpf, :password, :create_date)';

                        try {
                            $con = $db->prepare($query);
                            $con->bindValue(":cpf", $cpf);
                            $con->bindValue(":password", $hashed_password); 
                            $con->bindValue(":create_date", $createdDate);
                            $con->execute();
                            echo '<div class="alert alert-success" role="alert">
                                    Usuário cadastrado com sucesso!
                                  </div>';
                        } catch (\PDOException $e) {
                            echo '<div class="alert alert-danger" role="alert">
                                   Usuário já cadastrado ou erro no cadastro. Por favor, tente novamente.
                                  </div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                                As senhas não coincidem. Por favor, tente novamente.
                              </div>';
                    }
                }
            ?>

            <div class="row">
                <div class="col">   
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" name="cpf" maxlength="11" required id="cpf">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" required name="password">
                        </div>
                        <div class="mb-3">
                            <label for="passwordconfirm" class="form-label">Confirme a sua Senha</label>
                            <input type="password" class="form-control" id="passwordconfirm" required name="passwordconfirm">
                        </div>
                        <div class="mb-3 f">
                            <small><a href="index.php">Login</a></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script> //mask do cpf 
    $(document).ready(function(){
        $('#cpf').mask('000.000.000-00', {reverse: true});
    });
</script>

</body>
</html>
