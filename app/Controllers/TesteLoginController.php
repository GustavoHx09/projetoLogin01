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

        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (empty($email) || empty($senha)) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao logar!',
                'text' => 'TODOS os campos DEVEM ser preenchidos, verifique e tente novamente!'
            ];
            header("Location: /projetoLogin01/");  
            return false;      
            exit;
        } 

        if($this->loginModel->LogarUsuario($email, $senha)) {
            header("Location: /projetoLogin01/");
            exit;
        }

        return false;
        exit;
    }

    public static function logout() {
        session_unset();
        session_destroy();
        header("Location: /projetoLogin01/login");
        exit;
    }
}