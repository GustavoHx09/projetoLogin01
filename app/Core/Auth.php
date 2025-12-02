<?php

namespace App\Core;

class Auth {

    // verifica se a sessão ja contém um email logado, se nao tiver redireciona para o login
    public static function check() {    
        if (!isset($_SESSION['email'])) {
            header("Location: /projetoLogin01/login");
            exit;
        }
    }

    /* A implementar */
    public static function login($token) {
        $_SESSION['email'] = $token;
    }

    // destrói a sessão e redireciona para o login
    public static function logout() {
        session_destroy();
        header("Location: /projetoLogin01/login");
        exit;
    }
}
