<?php

namespace App\Models;

use App\Models\ConnectDB;
use PDOException;

class TesteLoginModel extends ConnectDB {

    private $conn;

    public function __construct() {
        $this->conn = parent::retornarConexao();
    }

    public function LogarUsuario() {

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        if (isset($_POST['senha'])) {
            $senha = $_POST['senha'];
        }
 
        if (trim($email == '')) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao logar!',
                'text' => 'O campo email deve ser preenchido!'
            ];
            return false;
        }
        if (trim($senha == '')) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao logar!',
                'text' => 'O campo senha deve ser preenchido!'
            ];
            return false;
        }
        
        try {
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
            
            if ($userFound == '') {
                $_SESSION['alert'] = [
                    'icon' => 'error',
                    'title' => 'Erro ao logar!',
                    'text' => 'Login inexistente, verifique e tente novamente!'
                ]; 
                return false;
            }
        } catch (PDOException $e){
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao logar!',
                'text' => 'Erro ao consultar dados no banco. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }

        // verifica se a senha fornecida bate com a senha vinculada ao email do banco
        if ($userFound['email'] && password_verify($senha, $userFound['senha'])) {

            // pego o primeiro e segundo nome se ouver para exibir em qualquer lugar no projeto
            $partNome = explode(' ', $userFound['nome']);
            $nome = $partNome[0];
            $sobrenome = isset($partNome[1]) ? $partNome[1] : '';
            $nomeSobrenome = trim($nome . ' ' . $sobrenome);

            $_SESSION['email'] = $userFound['email'];
            $_SESSION['nomeSobrenome'] = $nomeSobrenome;
            return true;
        } else {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao logar!',
                'text' => 'Login inválido, verifique e tente novamente!'
            ];
            return false;
        }
    }
}
