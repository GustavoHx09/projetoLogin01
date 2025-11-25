<?php

include_once('includes/pdo.php');

if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    echo "
            <script>
            Swal.fire({
                icon: '{$alert['icon']}',
                title: '{$alert['title']}',
                text: '{$alert['text']}',
                confirmButtonText: 'OK'
            });
            </script>
            ";
    unset($_SESSION['alert']);
}

if (isset($_POST['submit'])) {

    // recebe os dados do form. e armazena nas variáveis
    $nome = ($_POST['nome']);
    $cadastro_usuario = ($_POST['cadastro_usuarios']);
    $editar_usuario = ($_POST['editar_usuarios']);
    $listar_usuario = ($_POST['listar_usuarios']);
    $excluir_usuario = ($_POST['excluir_usuarios']);
    $cadastro_grupo = ($_POST['cadastro_grupos']);
    $editar_grupo = ($_POST['editar_grupos']);
    $listar_grupo = ($_POST['listar_grupos']);
    $excluir_grupo = ($_POST['excluir_grupos']);

    // faz a edição do grupo no banco de dados
    try {
        $sql = "UPDATE grupos SET
                    nome = '{$nome}',
                    cadastrar_usuario = '{$cadastro_usuario}', 
                    editar_usuario = '{$editar_usuario}', 
                    listar_usuario = '{$listar_usuario}', 
                    excluir_usuario = '{$excluir_usuario}', 
                    cadastrar_grupo = '{$cadastro_grupo}', 
                    editar_grupo = '{$editar_grupo}', 
                    listar_grupo = '{$listar_grupo}', 
                    excluir_grupo = '{$excluir_grupo}'
                WHERE id = " . $_REQUEST['id'];

        $stmt_ins = $conn->prepare($sql);
        $stmt_ins->execute();

        // se deu certo emite um alerta de sucesso
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Grupo alterado com sucesso!',
            'text' => "O grupo $nome foi alterado no banco de dados."
        ];
    } catch (PDOException $e) {
        // se deu erro emite um alerta de erro
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Erro ao editar!',
            'text' => 'Detalhes: ' . $e->getMessage()
        ];
    }

    header('Location: ?page=registrosGrupos');
    exit;
}
?>

<h1>Editar Grupo</h1>
<?php
$sql = "SELECT * FROM grupos WHERE id =" . $_REQUEST['id'];
$result = $conn->query($sql);
$row = $result->fetch(PDO::FETCH_OBJ);
?>
<form action="?page=editarGrupos" method="POST">
    <input type="hidden" name="id" value="<?php echo $row->id; ?>">

    <div class="mb-3">
        <label for="nome" class="form-label fw-bold">Nome do Grupo</label>
        <input type="text" name="nome" value="<?php echo $row->nome; ?>" id="nome" required class="form-control" placeholder="Digite o nome do grupo">
    </div>

    <div class="row">
        <!-- COLUNA 1: Permissões de Usuários -->
        <div class="col-md-6">
            <h4 class="text-primary mb-3">Permissões de Usuários</h4>

            <!-- Cadastrar Usuários -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Cadastrar Usuários:</label><br>
                <input type="radio" class="btn-check" name="cadastro_usuarios" id="cadastro_usuarios_sim" value="1">
                <label class="btn btn-outline-success btn-sm me-2" for="cadastro_usuarios_sim">Sim</label>

                <input type="radio" class="btn-check" name="cadastro_usuarios" id="cadastro_usuarios_nao" value="0" checked>
                <label class="btn btn-outline-danger btn-sm" for="cadastro_usuarios_nao">Não</label>
            </div>

            <!-- Editar Usuários -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Editar Usuários:</label><br>
                <input type="radio" class="btn-check" name="editar_usuarios" id="editar_usuarios_sim" value="1">
                <label class="btn btn-outline-success btn-sm me-2" for="editar_usuarios_sim">Sim</label>

                <input type="radio" class="btn-check" name="editar_usuarios" id="editar_usuarios_nao" value="0" checked>
                <label class="btn btn-outline-danger btn-sm" for="editar_usuarios_nao">Não</label>
            </div>

            <!-- Listar Usuários -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Listar Usuários:</label><br>
                <input type="radio" class="btn-check" name="listar_usuarios" id="listar_usuarios_sim" value="1">
                <label class="btn btn-outline-success btn-sm me-2" for="listar_usuarios_sim">Sim</label>

                <input type="radio" class="btn-check" name="listar_usuarios" id="listar_usuarios_nao" value="0" checked>
                <label class="btn btn-outline-danger btn-sm" for="listar_usuarios_nao">Não</label>
            </div>

            <!-- Excluir Usuários -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Excluir Usuários:</label><br>
                <input type="radio" class="btn-check" name="excluir_usuarios" id="excluir_usuarios_sim" value="1">
                <label class="btn btn-outline-success btn-sm me-2" for="excluir_usuarios_sim">Sim</label>

                <input type="radio" class="btn-check" name="excluir_usuarios" id="excluir_usuarios_nao" value="0" checked>
                <label class="btn btn-outline-danger btn-sm" for="excluir_usuarios_nao">Não</label>
            </div>
        </div>

        <!-- COLUNA 2: Permissões de Grupos e Produtos -->
        <div class="col-md-6">
            <h4 class="text-primary mb-3">Permissões de Grupos e Produtos</h4>

            <!-- Cadastrar Grupos -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Cadastrar Grupos:</label><br>
                <input type="radio" class="btn-check" name="cadastro_grupos" id="cadastro_grupos_sim" value="1">
                <label class="btn btn-outline-success btn-sm me-2" for="cadastro_grupos_sim">Sim</label>

                <input type="radio" class="btn-check" name="cadastro_grupos" id="cadastro_grupos_nao" value="0" checked>
                <label class="btn btn-outline-danger btn-sm" for="cadastro_grupos_nao">Não</label>
            </div>

            <!-- Editar Grupos -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Editar Grupos:</label><br>
                <input type="radio" class="btn-check" name="editar_grupos" id="editar_grupos_sim" value="1">
                <label class="btn btn-outline-success btn-sm me-2" for="editar_grupos_sim">Sim</label>

                <input type="radio" class="btn-check" name="editar_grupos" id="editar_grupos_nao" value="0" checked>
                <label class="btn btn-outline-danger btn-sm" for="editar_grupos_nao">Não</label>
            </div>

            <!-- Listar Grupos -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Listar Grupos:</label><br>
                <input type="radio" class="btn-check" name="listar_grupos" id="listar_grupos_sim" value="1">
                <label class="btn btn-outline-success btn-sm me-2" for="listar_grupos_sim">Sim</label>

                <input type="radio" class="btn-check" name="listar_grupos" id="listar_grupos_nao" value="0" checked>
                <label class="btn btn-outline-danger btn-sm" for="listar_grupos_nao">Não</label>
            </div>

            <!-- Excluir Grupos -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Excluir Grupos:</label><br>
                <input type="radio" class="btn-check" name="excluir_grupos" id="excluir_grupos_sim" value="1">
                <label class="btn btn-outline-success btn-sm me-2" for="excluir_grupos_sim">Sim</label>

                <input type="radio" class="btn-check" name="excluir_grupos" id="excluir_grupos_nao" value="0" checked>
                <label class="btn btn-outline-danger btn-sm" for="excluir_grupos_nao">Não</label>
            </div>

        </div>
    </div>

    <div class="text-center mt-4">
        <input type="submit" name="submit" id="submit" value="Atualizar Grupo" class="btn btn-success px-4">
    </div>
</form>