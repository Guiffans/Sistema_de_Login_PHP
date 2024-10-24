
# 🛡️ Sistema de Login em PHP

Este é um sistema básico de login e registro de usuários construído em PHP. Ele permite que os usuários façam login, se registrem e armazenem informações de cartões de crédito de forma criptografada. 

![image](https://github.com/user-attachments/assets/57745878-e173-4235-b660-ac830a0749ee)


## 🛠️ Tecnologias Utilizadas

- **PHP**: Linguagem principal do projeto.
- **PDO (PHP Data Objects)**: Interface para trabalhar com bancos de dados.
- **MySQL**: Banco de dados para armazenamento de usuários e informações de cartão de crédito.
- **Bootstrap**: Framework CSS para estilização.
- **jQuery**: Biblioteca JavaScript utilizada para mascarar campos de CPF e cartões de crédito.

![image](https://github.com/user-attachments/assets/65cd5c59-5a6d-4f5b-81a5-4b68e9eb6b9c)

## ⚙️ Funcionalidades

- Registro de usuário com CPF e senha.
- Login com validação de CPF e senha criptografada.
- Armazenamento seguro de informações de cartão de crédito (número do cartão e CVV são criptografados).
- Simulação divertida para descobrir o signo do usuário.

![image](https://github.com/user-attachments/assets/33f2c147-e8b7-4cbc-aebd-b29c4efed478)

 ![image](https://github.com/user-attachments/assets/b922ab01-8cfd-49c7-adc0-6368e4c0d23c)

## 🚀 Executando o Projeto

1. **Clone o repositório**:
    ```sh
    git clone https://github.com/seu-usuario/seu-repositorio.git
    cd seu-repositorio
    ```

2. **Configure o Banco de Dados**:
   - Crie um banco de dados MySQL chamado `sistema_login`.
   - Execute o seguinte SQL para criar as tabelas necessárias:

   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       cpf VARCHAR(11) NOT NULL,
       password VARCHAR(255) NOT NULL,
       create_date DATETIME
   );

   CREATE TABLE credit_cards (
       id INT AUTO_INCREMENT PRIMARY KEY,
       user_id INT NOT NULL,
       card_number VARCHAR(255) NOT NULL,
       card_holder_name VARCHAR(100) NOT NULL,
       expiry_date VARCHAR(5) NOT NULL,
       cvv VARCHAR(255) NOT NULL,
       FOREIGN KEY (user_id) REFERENCES users(id)
   );
   ```

3. **Configurações do Banco no PHP**:
   No arquivo `index.php`, altere as credenciais de conexão:
   ```php
   $db = new PDO('mysql:dbname=sistema_login;host=127.0.0.1:3306', 'seu_usuario', 'sua_senha');
   ```

4. **Inicie o servidor local**:
    ```sh
    php -S localhost:8000
    ```

5. **Acesse a aplicação**:
   Abra o navegador e vá para `http://localhost:8000`.

## 📂 Estrutura do Projeto

- `index.php`: Página principal para login de usuários.
- `register.php`: Página para registro de novos usuários.
- `dashboard.php`: Página de exemplo após o login (coleta de dados de cartão de crédito).
- `inc/header.php`: Arquivo de cabeçalho comum entre as páginas.
- `images/login-demo.png`: Imagem de exemplo para o README.

## 🔑 Endpoints

- **GET /index.php**: Página de login.
- **POST /index.php**: Processa o login do usuário.
- **GET /register.php**: Página de registro de novos usuários.
- **POST /register.php**: Processa o registro de um novo usuário.
- **GET /dashboard.php**: Página de coleta de dados de cartão de crédito (apenas após login).

## 🚨 Tratamento de Erros

- Alertas personalizados exibidos em caso de erro de login, senha incorreta ou CPF não registrado.
- Validação de formulário para garantir que todos os campos sejam preenchidos.

