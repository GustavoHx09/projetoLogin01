<?php

namespace App\Models;

use App\Models\ConnectDB;
use PDOException;

class UsersModel extends ConnectDB
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }

    // Listar Users
    public function listarUsers()
    {
        try {
            $sql = $this->conexao->prepare("SELECT u.id,
                                                    u.nome,
                                                    u.usuario,
                                                    u.email,
                                                    g.grupo AS grupo
                                            FROM usuarios u
                                            INNER JOIN grupos g
                                            ON g.id = u.fk_grupo
                                          ");
            $sql->execute();
            $users = $sql->fetchAll(\PDO::FETCH_ASSOC);

            if ($users == null) {
                $_SESSION['alert'] = [
                    'icon' => 'error',
                    'title' => 'Erro ao buscar registros',
                    'text' => 'Nenhum registro encontrado no banco de dados'
                ];
                return false;
            }
            return $users;
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao listar usuarios',
                'text' => 'Não foi possível fazer a consulta no banco. Erro -> ' . addslashes($e->getMessage()) // addslashes() -> remove caracteres especiais que impedem de abrir o alert por causa do javascript
            ];
            return false;
        }
    }

    public function listUserid($id)
    {
        try {
            $sql = $this->conexao->prepare("SELECT nome, 
                                                usuario,
                                                email,
                                                senha,
                                                fk_grupo
                                            FROM usuarios 
                                            WHERE id = $id");
            $sql->execute();
            $dados = $sql->fetch(\PDO::FETCH_ASSOC);

            if ($dados == null) {
                $_SESSION['alert'] = [
                    'icon' => 'error',
                    'title' => 'Erro ao listar dados',
                    'text' => 'Usuário não existente no banco'
                ];
                return false;
            }
            return $dados;
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao buscar dados.',
                'text' => 'Não foi possível trazer os dados do usuário para edição. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }
    }

    // Cadastrar Users
    public function cadastrarUser()
    {
        // verifica se os campos existem
        if (isset($_POST['nome'])) {
            $nome = $_POST['nome'];
        }
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        if (isset($_POST['usuario'])) {
            $usuario = $_POST['usuario'];
        }
        if (isset($_POST['senha'])) {
            $senha = $_POST['senha'];
        }
        if (isset($_POST['id_grupo'])) {
            $grupo = $_POST['id_grupo'];
        }

        // verifica se não estão vazios
        if (trim($nome) == '') {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar usuário!',
                'text' => 'O campo nome não pode ser nulo.'
            ];
            return false;
        }
        if (trim($email) == '') {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar usuário!',
                'text' => 'O campo email não pode ser nulo.'
            ];
            return false;
        }
        if (trim($usuario) == '') {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar usuário!',
                'text' => 'O campo usuário não pode ser nulo.'
            ];
            return false;
        }
        if (trim($senha) == '') {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar usuário!',
                'text' => 'O campo senha não pode ser nulo.'
            ];
            return false;
        }
        if (trim($grupo) == '') {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar usuário!',
                'text' => 'O grupo do usuário deve ser selecionado.'
            ];
            return false;
        }

        // verifica se o usuário já existe
        try {
            $sql = $this->conexao->prepare("SELECT usuario 
                                    FROM usuarios
                                    WHERE usuario = :usuario");
            $sql->bindValue(':usuario', $usuario);
            $sql->execute();
            $result = $sql->fetch(\PDO::FETCH_ASSOC);

            if ($result) {
                $_SESSION['alert'] = [
                    'icon' => 'error',
                    'title' => 'Erro ao cadastrar usuário!',
                    'text' => 'Usuário ' . $usuario . ' ja existe no banco de dados.'
                ];
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar grupo!',
                'text' => 'Erro de verificação. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }

        // faz o cadastro do usuário
        try {
            $sql = $this->conexao->prepare("INSERT INTO usuarios 
                                                    (nome, 
                                                    email, 
                                                    usuario, 
                                                    senha, 
                                                    fk_grupo) 
                                            VALUES (:name, 
                                                    :email, 
                                                    :usuario,
                                                    :password, 
                                                    :id_grupo)");
            $sql->bindValue(':name', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':usuario', $usuario);
            $sql->bindValue(':password', password_hash($senha, PASSWORD_BCRYPT));
            $sql->bindValue(':id_grupo', $grupo);
            $sql->execute();

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Usuário Cadastrado!',
                'text' => 'Usuário ' . $nome . ' cadastrado com sucesso!'
            ];
            return true;
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar usuário!',
                'text' => 'Erro ao inserir usuário no banco de dados. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }
    }

    // Atualizar UsersRoles
    public function editarUser($id, $oldName)
    {
        $dados = $_POST;
        // armazeno os campo para o sql
        $campos = [];
        // uso para definir os parâmetros dos campos
        $params = [];

        // faço as validações necessárias para o sql
        if (isset($dados['nome']) && !empty($dados['nome'])) {
            $campos[] = "nome = :nome";
            $params[':nome'] = $dados['nome'];
        }
        if (isset($dados['email']) && !empty($dados['email'])) {
            $campos[] = "email = :email";
            $params[':email'] = $dados['email'];
        }
        if (isset($dados['senha']) && !empty($dados['senha'])) {
            $campos[] = "senha = :senha";
            $params[':senha'] = password_hash($dados['senha'], PASSWORD_BCRYPT);
        }
        if (isset($dados['fk_grupo']) && !empty($dados['fk_grupo'])) {
            $campos[] = "fk_grupo = :fk_grupo";
            $params[':fk_grupo'] = $dados['fk_grupo'];
        }

        // faz a atualização do usuário
        try {
            $sql = $this->conexao->prepare("UPDATE usuarios SET 
                                                " . implode(", ", $campos) . " 
                                            WHERE id = :id");
            $sql->bindValue(':id', $id);
            // so faz a inclusão no sql com os parâmetros que existirem                         
            if (isset($params[':nome'])) {
                $sql->bindValue(':nome', $params[':nome']);
            }
            if (isset($params[':email'])) {
                $sql->bindValue(':email', $params[':email']);
            }
            if (isset($params[':senha'])) {
                $sql->bindValue(':senha', $params[':senha']);
            }
            if (isset($params[':fk_grupo'])) {
                $sql->bindValue(':fk_grupo', $params[':fk_grupo']);
            }
            $sql->execute();

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Usuário Atualizado!',
                'text' => 'Usuário ' . $oldName['nome'] . ' atualizado com sucesso!'
            ];
            return true;
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao atualizar usuário!',
                'text' => 'Não foi possível atualizar os dados do usuário. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }
    }

    // Deletar Usuario
    public function deletarUser($id, $oldName)
    {
        // faz a exclusão do usuário
        try {
            $sql = $this->conexao->prepare("DELETE FROM usuarios 
                                            WHERE id = :id
                                        ");
            $sql->bindValue(':id', $id);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao deletar o usuário!',
                'text' => 'Não foi possível deletar o usuário ' . $oldName['nome'] . '. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }
    }
}
