<?php

namespace App\Models;

use App\Models\ConnectDB;
use PDOException;

class GruposModel extends ConnectDB
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }

    // Listar grupos
    public function listarGrupos()
    {
        try {
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

            if ($grupos == null) {
                $_SESSION['alert'] = [  
                'icon' => 'error',
                'title' => 'Erro ao listar grupos',
                'text' => 'Não existe nenhum registro no banco de dados'
                ];
                return false;
            }
            return $grupos;
        } catch (PDOException $e){
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao listar grupos',
                'text' => 'Não foi possível fazer a consulta no banco. Erro -> ' . addslashes($e->getMessage()) // addslashes() -> remove caracteres especiais que impedem de abrir o alert por causa do javascript
            ];
            return false;
        }
    }

    // Pegar dados de um grupo
    public function listGrupoid($id)
    {
        try {
            $sql = $this->conexao->prepare("SELECT * 
                                            FROM grupos
                                            WHERE id = $id");
            $sql->execute();
            $dados = $sql->fetch(\PDO::FETCH_ASSOC);

            if ($dados == null) {
                $_SESSION['alert'] = [  
                'icon' => 'error',
                'title' => 'Erro ao listar dados',
                'text' => 'Grupo não existente no banco'
                ];
                return false;
            }
            return $dados;
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao buscar dados.',
                'text' => 'Não foi possível trazer os dados do grupo para edição. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }
    }

    // Cadastrar Grupo
    public function cadastrarGrupo()
    {
        $nome = $_POST['grupo'];
        if(trim($nome) == null) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar grupo!',
                'text' => 'O nome não pode ser nulo.'
            ];
            return false;
        }

        try {
            $sql = $this->conexao->prepare("SELECT grupo 
                                    FROM grupos
                                    WHERE grupo = :grupo");
            $sql->bindValue(':grupo', $nome);
            $sql->execute();
            $result = $sql->fetch(\PDO::FETCH_ASSOC);

            if (!$result) {
                $grupo = $nome;
            } else {
                $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar grupo!',
                'text' => 'Grupo '. $nome .' ja existe no banco de dados.'
                ];
                return false;
            }
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar grupo!',
                'text' => 'Erro ao verificar grupo. Erro -> '. addslashes($e->getMessage()) 
            ];
            return false;
        }
        
        $dados['cadastrar'] = isset($_POST['cadastrar']) ? 1 : 0;
        $dados['listar'] = isset($_POST['listar']) ? 1 : 0;
        $dados['editar'] = isset($_POST['editar']) ? 1 : 0;
        $dados['deletar'] = isset($_POST['deletar']) ? 1 : 0;

        try {
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
                                                        :deletar)");
            $sql->bindValue(':grupo', $grupo);
            $sql->bindValue(':cadastrar', $dados['cadastrar']);
            $sql->bindValue(':listar', $dados['listar']);
            $sql->bindValue(':editar', $dados['editar']);
            $sql->bindValue(':deletar', $dados['deletar']);
            $sql->execute();

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Grupo Cadastrado!',
                'text' => 'Grupo '. $dados["grupo"] .' cadastrado com sucesso!'
            ];            
            return true;
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao cadastrar grupo!',
                'text' => 'Erro ao inserir grupo no banco de dados. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }
    }

    // Atualizar Grupo
    public function editarGrupo($id, $oldGrupo) 
    {
        $dados['grupo'] = $_POST['grupo'];
        $dados['cadastrar'] = isset($_POST['cadastrar']) ? 1 : 0;
        $dados['listar'] = isset($_POST['listar']) ? 1 : 0;
        $dados['editar'] = isset($_POST['editar']) ? 1 : 0;
        $dados['deletar'] = isset($_POST['deletar']) ? 1 : 0;

        try {
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
            $sql->execute();

            $_SESSION['alert'] = [
                'icon' => 'success',
                'title' => 'Grupo Atualizado!',
                'text' => 'Grupo '. $oldGrupo['grupo'] .' atualizado com sucesso!'
            ];
            return true;
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao atualizar grupo!',
                'text' => 'Não foi possível atualizar os dados do grupo '. $oldGrupo['grupo'] .'. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }
    }

    // Deletar grupo
    public function deletarGrupo($id, $oldGrupo) 
    {
        try {
            $sql = $this->conexao->prepare("DELETE FROM grupos 
                                        WHERE id = :id
                                    ");
            $sql->bindValue(':id', $id);
            $sql->execute();

            return true;
        } catch (PDOException $e) {
            $_SESSION['alert'] = [
                'icon' => 'error',
                'title' => 'Erro ao deletar grupo!',
                'text' => 'Não foi possível deletar o grupo '. $oldGrupo['grupo'] .'. Erro -> ' . addslashes($e->getMessage())
            ];
            return false;
        }
    }
}