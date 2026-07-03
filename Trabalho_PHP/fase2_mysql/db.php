<?php
$host = 'localhost';
$db   = 'todo_db';
$user = 'root';
$pass = ''; // No ambiente padrão do sandbox geralmente não tem senha para root ou o usuário é ubuntu
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // Em produção, não mostre a mensagem de erro detalhada
     die("Erro de conexão: " . $e->getMessage());
}
?>
