<?php 

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\GruposModel;
use App\Core\Auth;

class UsersController {

    private $userModel, $grupoModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->grupoModel = new GruposModel();
    }
    
    // listar usuarios
    public function listar() 
    {
        Auth::check();
        $users = $this->userModel->listarUsers();
        include __DIR__ . '/../Views/PagesUsuarios/listUsers.php';
        return true;
    }

    // lista os grupos pro select no cadastro de usuarios
    public function formNew()
    {
        Auth::check();
        $grupos = $this->grupoModel->listarGrupos();
        include __DIR__ . '/../Views/PagesUsuarios/cadastro.php';
        return true;
    }

    // editar usuarios
    public function formEdit($id)
    {
        Auth::check();
        $dados = $this->userModel->listUserid($id);
        // busca os grupos existentes reaproveitando o select do GruposModel
        $grupos = $this->grupoModel->listarGrupos();
        include __DIR__ . '/../Views/PagesUsuarios/editar.php';
        return true;
    }

    // cadastrar usuarios
    public function cadastrar() 
    {
        Auth::check();
        $result = $this->userModel->cadastrarUser();
        if ($result === false) {
            header('Location: /projetoLogin01/users/new');
            return false;
        } else {
            header('Location: /projetoLogin01/users');
            return true;
        }
    }

    // editar usuarios
    public function editar($id) 
    {
        Auth::check();
        $oldName = $this->userModel->listUserid($id);
        $result = $this->userModel->editarUser($id, $oldName);
        if ($result === false) {
            header('Location: /projetoLogin01/users/edit/'.$id.'');
            return false;
        } else {
            header('Location: /projetoLogin01/users');
            return true;
        }
    }

    // deletar usuarios
    public function delete($id) 
    {
        Auth::check();
        $oldName = $this->userModel->listUserid($id);
        $this->userModel->deletarUser($id, $oldName);
        header("Location: /projetoLogin01/users");
        return true;
    }
}