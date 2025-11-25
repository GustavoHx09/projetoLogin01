<?php 
namespace App\Controllers;

use App\Models\GruposModel;
use App\Models\UsersModel;

class GruposController {

    private $grupoModel, $userModel;

    public function __construct() {
        $this->grupoModel = new GruposModel();
        $this->userModel = new UsersModel();
    }

    // Listar Grupos
    public function listar() 
    {
        $grupos = $this->grupoModel->listarGrupos();
        return $grupos;
    }


    // chama o formulario
    public function form(){
        include __DIR__ . '/../Views/PagesUsuarios/cadastro.php';
    }

    // cadastrar usuarios
    public function cadastrar() {
        $this->grupoModel->cadastrar();
        return true;
    }

    // editar usuarios
    public function editar() {
        $users = $this->grupoModel->editar();
        include __DIR__ . '/../Views/PagesUsuarios/listUsers.php';
        return $users;
    }

    // deletar usuarios
    public function deletar() {
        $users = $this->grupoModel->deletar();
        include __DIR__ . '/../Views/PagesUsuarios/listUsers.php';
        return $users;
    }
}


?>