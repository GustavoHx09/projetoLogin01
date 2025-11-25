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
                                            nome 
                                        FROM grupos 
                                        ORDER BY nome");
        $sql->execute();
        $grupos = $sql->fetchAll(\PDO::FETCH_ASSOC);

        return $grupos;
    }

    // Cadastrar UsersRoles
    public function CadastrarUserRolesModel($usuario, $dados, $response)
    {

        $sql = $this->conexao->prepare(" INSERT INTO tb_users_permission 
                                                    (id_user,
                                                    route,
                                                    get,
                                                    post,
                                                    put,
                                                    del) 
                                            VALUES (:id_user,
                                                    :route,
                                                    :get,
                                                    :post,
                                                    :put,
                                                    :del) ");
        $sql->bindValue(':id_user', $dados->data['id_user']);
        $sql->bindValue(':route', $dados->data['route']);
        $sql->bindValue(':get', $dados->data['method']['get']);
        $sql->bindValue(':post', $dados->data['method']['post']);
        $sql->bindValue(':put', $dados->data['method']['put']);
        $sql->bindValue(':del', $dados->data['method']['del']);
        $result = $sql->execute();


        if (!$result) {
            $response->status = 'error';
            $response->code_error = 500;
            $response->message = 'Erro ao cadastrar users roles';

            return false;
        } else {
            $response->status = 'success';
            $response->code_error = 200;
            $response->message = 'User ' . $dados->data['id_user'] . ' cadastrado com sucesso';
            $response->data = true;
        }

        return true;
    }


    // Atualizar UsersRoles
    public function AtualizarUserRolesModel($usuario, $dados, $response)
    {

        $sql = $this->conexao->prepare("UPDATE tb_users_permission 
                                        SET get = :get, post = :post, put = :put, del = :del 
                                        WHERE id_user = :id_user 
                                        AND route = :route");

        $sql->bindValue(':id_user', $dados->data['id_user']);
        $sql->bindValue(':route', $dados->data['route']);
        $sql->bindValue(':get', $dados->data['method']['get']);
        $sql->bindValue(':post', $dados->data['method']['post']);
        $sql->bindValue(':put', $dados->data['method']['put']);
        $sql->bindValue(':del', $dados->data['method']['del']);
        $result = $sql->execute();


        if (!$result) {
            $response->status = 'error';
            $response->code_error = 500;
            $response->message = 'Erro ao atualizar users roles';

            return false;
        } else {
            $response->status = 'success';
            $response->code_error = 200;
            $response->message = 'User ' . $dados->data['id_user'] . ' atualizado com sucesso';
            $response->data = true;
        }

        return true;
    }


    // Deletar UsersRoles
    public function DeletarUserRolesModel($usuario, $dados, $response)
    {

        $sql = $this->conexao->prepare("DELETE FROM tb_users_permission 
                                        WHERE id_user = :id_user 
                                        AND route = :route");
        $sql->bindValue(':id_user', $dados->data['id_user']);
        $sql->bindValue(':route', $dados->data['route']);
        $resultado = $sql->execute();

        if (!$resultado) {
            $response->status = 'error';
            $response->code_error = 500;
            $response->message = 'Erro ao deletar users roles';
            return false;
        } else {
            $response->status = 'success';
            $response->code_error = 200;
            $response->message = 'User ' . $dados->data['id_user'] . ' deletado com sucesso';
            $response->data = true;
        }

        return true;
    }
}
