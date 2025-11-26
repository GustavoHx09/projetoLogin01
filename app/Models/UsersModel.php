<?php 

namespace App\Models;

use App\Models\ConnectDB;

class UsersModel extends ConnectDB{

    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }

    // Listar Users
    public function listarUsers() 
    {
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

        return $users;
    }

    public function listUserid($id){
        
        $sql = $this->conexao->prepare("SELECT nome, 
                                            usuario,
                                            email,
                                            senha,
                                            fk_grupo
                                        FROM usuarios 
                                        WHERE id = $id");
        $sql->execute();
        $dados = $sql->fetch(\PDO::FETCH_ASSOC);

        return $dados;
    }

    // Cadastrar Users
    public function cadastrarUser()
    {
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
        $sql->bindValue(':name', $_POST['nome']);
        $sql->bindValue(':email', $_POST['email']);
        $sql->bindValue(':usuario', $_POST['usuario']);
        $sql->bindValue(':password', password_hash($_POST['senha'], PASSWORD_BCRYPT));
        $sql->bindValue(':id_grupo', $_POST['id_grupo']);
        $result = $sql->execute();

        if(!$result){
            echo "Não foi possivel inserir no banco de dados!";
            return false;
            exit;
        } else {
            return true;
        }

    }

    // Atualizar UsersRoles
    public function editarUser($id, $dados) {

        // ARMAZENO OS CAMPOS PARA COLOCAR NA SQL
        $campos = [];
        // USO PARA DEFINIR O VALOR DOS PARAMETROS
        $params = [];

        if (isset($dados['nome']) && !empty($dados['nome'])) {

            // AQUI CRIO UM CAMPO PARA PODER CHAMAR NA CONSULTA SQL
            $campos[] = "nome = :nome";
            // AQUI FAÇO ALGO PARECIDO COM O BINDVALUE
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

        // atualiza os dados no banco
        $sql = $this->conexao->prepare("UPDATE usuarios SET 
                                            " . implode(", ", $campos) . " 
                                        WHERE id = $id");
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


        $result = $sql->execute();

        if(!$result){
            echo "Não foi possivel inserir no banco de dados!";
            return false;
            exit;
        } else {
            return true;
        }

    }


    // Deletar Usuario
    public function deletarUser($id) {
        $sql = $this->conexao->prepare("DELETE FROM usuarios 
                                        WHERE id = :id
                                    ");
        $sql->bindValue(':id', $id);
        $resultado = $sql->execute();

        if (!$resultado) {
            return false;
            exit;
        } else {
            return true;
            exit;
        }

    }

}