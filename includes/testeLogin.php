<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {

    include_once('pdo.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT u.email, u.nome, u.senha, u.fk_grupo, g.nome AS nome_grupo 
            FROM usuarios u
            JOIN grupos g ON g.id = u.fk_grupo
            WHERE email = '$email'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $reg = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($reg['email'] && password_verify($senha, $reg['senha'])) {
        session_start();
        $_SESSION['email'] = $reg['email'];
        $_SESSION['nome'] = $reg['nome'];
        header('Location: ../home.php');
        exit;
    } else {
        session_unset();
        header('Location: ../index.php?erro=login');
        exit;
    }
    
} else {
    session_unset();
    header('Location: index.php');
    exit;
}

?>