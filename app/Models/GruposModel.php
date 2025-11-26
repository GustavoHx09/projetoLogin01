<?php

namespace App\Models;

use App\Models\ConnectDB;

class GruposModel extends ConnectDB
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }

    // Listar Grupos
    public function listarGrupos()
    {
        $sql = $this->conexao->prepare("SELECT id, 
                                            grupo,
                                            cadastrar,
                                            listar,
                                            editar,
                                            deletar
                                        FROM grupos 
                                        ORDER BY grupo");
        $sql->execute();
        $grupos = $sql->fetchAll(\PDO::FETCH_ASSOC);
        return $grupos;
    }

    // Listar dados do grupo
    public function listgrupoid($id){
        
        $sql = $this->conexao->prepare("SELECT * 
                                        FROM grupos
                                        WHERE id = $id");
        $sql->execute();
        $dados = $sql->fetch(\PDO::FETCH_ASSOC);

        return $dados;
    }

    // Cadastrar Grupo
    public function cadastrarGrupo()
    {
        $dados['cadastrar'] = isset($_POST['cadastrar']) ? 1 : 0;
        $dados['listar'] = isset($_POST['listar']) ? 1 : 0;
        $dados['editar'] = isset($_POST['editar']) ? 1 : 0;
        $dados['deletar'] = isset($_POST['deletar']) ? 1 : 0;
        
        $sql = $this->conexao->prepare(" INSERT INTO grupos 
                                                (grupo,
                                                cadastrar,
                                                listar,
                                                editar,
                                                deletar) 
                                        VALUES (:grupo,
                                                :cadastrar,
                                                :listar,
                                                :editar,
                                                :deletar)
                                    ");
        $sql->bindValue(':grupo', $_POST['grupo']);
        $sql->bindValue(':cadastrar', $dados['cadastrar']);
        $sql->bindValue(':listar', $dados['listar']);
        $sql->bindValue(':editar', $dados['editar']);
        $sql->bindValue(':deletar', $dados['deletar']);
        $result = $sql->execute();


        if (!$result) {
            return false;
        } else {
            return true;   
        }
    }

    // Atualizar Grupo
    public function editarGrupo($id, $dados) {
        $sql = $this->conexao->prepare("UPDATE grupos SET 
                                                grupo = :grupo,
                                                cadastrar = :cadastrar,
                                                listar = :listar,
                                                editar = :editar,
                                                deletar = :deletar
                                        WHERE id = $id
                                        ");
        $sql->bindValue(':grupo', $dados['grupo']);
        $sql->bindValue(':cadastrar', $dados['cadastrar']);
        $sql->bindValue(':listar', $dados['listar']);
        $sql->bindValue(':editar', $dados['editar']);
        $sql->bindValue(':deletar', $dados['deletar']);
        $result = $sql->execute();

        if(!$result){
            echo "Não foi possivel inserir no banco de dados!";
            return false;
            exit;
        } else {
            return true;
        }

    }

    // Deletar UsersRoles
    public function deletarGrupo($id) 
    {
        $sql = $this->conexao->prepare("DELETE FROM grupos 
                                        WHERE id = :id
                                    ");
        $sql->bindValue(':id', $id);
        $resultado = $sql->execute();

        if (!$resultado) {
            
            return false;
        } else {
            return true;
        }
    }
}