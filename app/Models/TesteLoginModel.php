<?php

namespace App\Models;

use App\Models\ConnectDB;
use PDOException;

class TesteLoginModel extends ConnectDB {

    private $conn;

    public function __construct() {
        $this->conn = parent::retornarConexao();
    }

    public function LogarUsuario($email,$senha) {

        $sql = $this->conn->prepare("SELECT u.email, 
                                            u.nome, 
                                            u.senha, 
                                            u.fk_grupo, 
                                            g.grupo AS nome_grupo 
                                    FROM usuarios u
                                    JOIN grupos g 
                                    ON g.id = u.fk_grupo
                                    WHERE email = '$email'");
        $sql->execute();
        $userFound = $sql->fetch(\PDO::FETCH_ASSOC);

        if (!$userFound) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao logar!',
                'text' => 'Login inválido ou inexistente, verifique e tente novamente!'
            ];
            header("Location: /projetoLogin01/");  
            return false;      
            exit;
        } else {
            // verifica se a senha fornecida bate com a senha vinculada ao email do banco
            if ($userFound['email'] && password_verify($senha, $userFound['senha'])) {
                session_start();
                $_SESSION['email'] = $userFound['email'];
                $_SESSION['nome'] = $userFound['nome'];
                return true;
                exit;
            } else {
                $_SESSION['alert'] = [
                    'icon' => 'error',
                    'title' => 'Erro ao logar!',
                    'text' => 'Login inválido ou inexistente, verifique e tente novamente!'
                ];
                header("Location: /projetoLogin01/");
                return false;
                exit;
            }
        }
    }
}
