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

    // Listar Grupos
    public function listar() 
    {
        Auth::check();
        $grupos = $this->grupoModel->listarGrupos();
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
        $grupo = $this->grupoModel->listGrupoid($id);
        include __DIR__ . '/../Views/PagesGrupos/editar.php';
        return true;
    }

    // cadastrar usuarios
    public function cadastrar() 
    {
        Auth::check();
        $this->grupoModel->cadastrarGrupo();
        header('Location: /projetoLogin01/grupos');
        return true;
    }

    // editar grupos
    public function editar($id) 
    {
        Auth::check();
        $dados['grupo'] = $_POST['grupo'];
        $dados['cadastrar'] = isset($_POST['cadastrar']) ? 1 : 0;
        $dados['listar'] = isset($_POST['listar']) ? 1 : 0;
        $dados['editar'] = isset($_POST['editar']) ? 1 : 0;
        $dados['deletar'] = isset($_POST['deletar']) ? 1 : 0;

        if ($this->grupoModel->editarGrupo($id, $dados)) {
            header('Location: /projetoLogin01/grupos');
        }
        return true;
    }

    // deletar usuarios
    public function deletar($id) 
    {
        Auth::check();
        $this->grupoModel->deletarGrupo($id);
        header('Location: /projetoLogin01/grupos');
        return true;
    }
}


?>