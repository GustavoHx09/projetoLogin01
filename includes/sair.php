<?php 
// faz logout
    session_start();
    session_unset();
    header('Location: ../index.php');
?>