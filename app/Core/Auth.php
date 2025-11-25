<?php

namespace App\Core;

class Auth {

    public static function check() {    
        if (!isset($_SESSION['email'])) {
            header("Location: /projetoLogin01/login");
            exit;
        }
    }

    public static function login($token) {
        $_SESSION['email'] = $token;
    }

    public static function logout() {
        session_destroy();
        header("Location: /projetoLogin01/login");
        exit;
    }
}
