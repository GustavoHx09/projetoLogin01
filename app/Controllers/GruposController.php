<?php 
namespace App\Controllers;

use App\Models\GruposModel;
use App\Models\UsersModel;
use App\Core\Auth;

class GruposController {

    private $grupoModel, $userModel;

    public function __construct() {
        $this->grupoModel = new GruposModel();
        $this->userModel = new UsersModel();
    }

    // lista os grupos
    public function listar() 
    {
        Auth::check();
        $result = $this->grupoModel->listarGrupos();
        include __DIR__ . '/../Views/PagesGrupos/listGrupos.php'; 
        return true;
    }

    // chama o formulario de cadastro
    public function formNew()
    {
        Auth::check();
        include __DIR__ . '/../Views/PagesGrupos/cadastro.php';
        return true;
    }

    // chama o formulario de edição
    public function formEdit($id)
    {
        Auth::check();
        $result = $this->grupoModel->listGrupoid($id);
        include __DIR__ . '/../Views/PagesGrupos/editar.php';
        return true;
    }

    // cadastrar grupo
    public function cadastrar() 
    {
        Auth::check();
        $result = $this->grupoModel->cadastrarGrupo();
        header("Location: /projetoLogin01/grupos");
        return true;
    }

    // editar grupo
    public function editar($id) 
    {
        Auth::check();    
        // apenas para pegar o nome do grupo antigo para exibir no alert
        $oldGrupo = $this->grupoModel->listGrupoid($id);
        $result = $this->grupoModel->editarGrupo($id, $oldGrupo);
        header('Location: /projetoLogin01/grupos');
        return true;
    }

    // deletar grupo
    public function deletar($id) 
    {
        Auth::check();
        $oldGrupo = $this->grupoModel->listGrupoid($id);
        $this->grupoModel->deletarGrupo($id, $oldGrupo);
        header('Location: /projetoLogin01/grupos');
        return true;
    }
}

?>