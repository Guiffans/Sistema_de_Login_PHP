<?php
session_start();
require_once 'inc/header.php';

?>

<div class="container">
    <div class="card p-3 m-5">
        <h1>Faça seu login</h1>
        <div class="card-body">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $cpf = $_POST['cpf'];
                $password = $_POST['password'];
                   
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    try {
                        $db = new PDO('mysql:dbname=sistema_login;host=127.0.0.1:3306', 'root', 'root-password');

                        $query = 'SELECT * FROM users WHERE cpf = :cpf';
                        $con = $db->prepare($query);
                        $con->bindValue(":cpf", $cpf);
                        $con->execute();

                        // Busca do usuário
                        if ($con->rowCount() > 0) {
                            
                            $user = $con->fetch(PDO::FETCH_ASSOC);
                            $hashed_password_from_db = $user['password'];

                            // Verificar senha
                            if (password_verify($password, $hashed_password_from_db)) {
                                echo '<div class="alert alert-success" role="alert">
                                        Login realizado com sucesso!
                                      </div>';
                                //salva o id do user
                                $_SESSION['user_id'] = $user['id'];
                                
                                header('Location: dashboard.php');
                                exit(); 

                            } else {
                                echo '<div class="alert alert-danger" role="alert">
                                        Senha incorreta. Por favor, tente novamente.
                                      </div>';
                            }
                        } else {
                        
                            echo '<div class="alert alert-danger" role="alert">
                                    CPF não encontrado. Por favor, tente novamente.
                                  </div>';
                        }
                    } catch (PDOException $e) {
                        echo '<div class="alert alert-danger" role="alert">
                                Ocorreu um erro ao tentar conectar ao banco de dados: '.$e->getMessage().'
                              </div>';
                    }
                }
            
            ?>

            <div class="row">
                <div class="col">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <small><a href="register.php">Registrar</a></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#cpf').mask('000.000.000-00', {reverse: true});
    });
</script>

</body>
</html>
