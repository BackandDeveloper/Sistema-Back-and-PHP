## Sistema de Back-end em PHP
Este projeto é um sistema de back-end completo em PHP para um site, incluindo autenticação de usuários, gerenciamento de sessões e interação com um banco de dados MySQL.

## Funcionalidades

Registro de usuários

Login de usuários

Gerenciamento de sessões

Página protegida

Logout

## Como Usar
Clone este repositório para o seu ambiente local:

bash
git clone https://github.com/SeuUsuario/SeuRepositorio.git
cd SeuRepositorio
Configure o banco de dados MySQL conforme o arquivo config.php.

Carregue os arquivos PHP no seu servidor web.

Acesse register.php para registrar um novo usuário.

Acesse login.php para fazer login.

Acesse dashboard.php para ver a página protegida.

Estrutura do Código
config.php
php
<?php
$host = 'localhost';
$db = 'meu_site';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
register.php
php
<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senha]);

    echo "Usuário registrado com sucesso!";
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    Email: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    <button type="submit">Registrar</button>
</form>
login.php
php
<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($enha, $usuario['senha'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        echo "Login bem-sucedido!";
    } else {
        echo "Email ou senha incorretos!";
    }
}
?>

<form method="POST">
    Email: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    <button type="submit">Login</button>
</form>
dashboard.php
php
<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

echo "Bem-vindo ao painel!";
?>

<a href="logout.php">Logout</a>
logout.php
php
<?php
session_start();
session_destroy();
header('Location: login.php');
exit();
?>
Contribuições
Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e pull requests para melhorias e novas funcionalidades.

Licença
Este projeto está licenciado sob a Licença MIT. Veja o arquivo LICENSE para mais detalhes.
