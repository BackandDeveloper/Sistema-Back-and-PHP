<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

echo "Bem-vindo ao painel!";
?>

<a href="logout.php">Logout</a>
