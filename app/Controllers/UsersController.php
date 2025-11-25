<?php 

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\GruposModel;

class UsersController {

    private $userModel, $grupoModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->grupoModel = new GruposModel();
    }
    
    // listar usuarios
    public function listar() {
        $users = $this->userModel->listar();
        include __DIR__ . '/../Views/PagesUsuarios/listUsers.php';
        return $users;
    }

    // lista os grupos pro select no cadastro de usuarios
    public function formNew(){
        $grupos = $this->grupoModel->listarGrupos();
        include __DIR__ . '/../Views/PagesUsuarios/cadastro.php';
        return true;
    }

    public function formEdit($id){
        $dados = $this->userModel->listUserid($id);
        // busca os grupos existentes reaproveitando o select do GruposModel
        $grupos = $this->grupoModel->listarGrupos();

        include __DIR__ . '/../Views/PagesUsuarios/editar.php';
        return true;
    }

    // cadastrar usuarios
    public function cadastrar() {
        if ($this->userModel->cadastrar()) {
            header('Location: /projetoLogin01/users');
        }
    
        return true;
    }

    // editar usuarios
    public function editar($id) {
        $dados = $_POST;
        $this->userModel->listUserid($id);
        if ($this->userModel->editarUser($id, $dados)) {
            header('Location: /projetoLogin01/users');
        }
        return true;
    }

    // deletar usuarios
    public function delete($id) {
        $this->userModel->deletarUser($id);
        header("Location: /projetoLogin01/users");
        return true;
    }

}