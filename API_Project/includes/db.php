<?php
$host = 'localhost';
$db = 'api_project';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charsetutf8";
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
}
?>