<?php

namespace App\Controllers;

use App\Models\TesteLoginModel;

class TesteLoginController {

    private $loginModel;

    public function __construct(){
        $this->loginModel = new TesteLoginModel();
    }

    public function show() {
        include __DIR__ . '/../Views/testeLogin.php';
    }

    public function login() {
        $result = $this->loginModel->LogarUsuario();
        if($result === false) {
            header("Location: /projetoLogin01/login");
            return false;
        } else {
            header("Location: /projetoLogin01/");
            return true;
        }
    }

    public static function logout() {
        session_destroy();
        header("Location: /projetoLogin01/login");
        return true;
    }
}