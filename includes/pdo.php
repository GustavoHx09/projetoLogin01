<?php
$servername = "";
$dbname = "";
$username = "";
$password = "";

global $conn;

//faz conexao com o banco
try {

    $conn = new PDO("mysql:host=;dbname=", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Falha na conexao: " . $e->getMessage();
    exit;
}
