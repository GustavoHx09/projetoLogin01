<?php
$servername = "seu servidor";
$dbname = "seu banco";
$username = "seu user";
$password = "sua senha";

global $conn;

//faz conexao com o banco
try {

    $conn = new PDO("mysql:host=".$servername.";dbname=".$dbname."", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Falha na conexao: " . $e->getMessage();
    exit;
}