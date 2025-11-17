<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

include_once('includes/pdo.php');

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


    // faz a inserção do grupo no banco de dados
    try {
        $sql = "INSERT INTO grupos 
                        (nome, 
                        cadastrar_usuario, 
                        editar_usuario, 
                        listar_usuario, 
                        excluir_usuario, 
                        cadastrar_grupo, 
                        editar_grupo, 
                        listar_grupo, 
                        excluir_grupo) 
                VALUES ('$nome', 
                        '$cadastro_usuario', 
                        '$editar_usuario', 
                        '$listar_usuario', 
                        '$excluir_usuario', 
                        '$cadastro_grupo', 
                        '$editar_grupo', 
                        '$listar_grupo', 
                        '$excluir_grupo')";
        $stmt_ins = $conn->prepare($sql);
        $stmt_ins->execute();

        // se deu certo cria um alerta de sucesso
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Grupo inserido com sucesso!',
            'text' => "O grupo $nome foi inserido no banco de dados."
        ];
    } catch (PDOException $e) {
        // se deu erro cria um alerta de erro
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Erro ao cadastrar!',
            'text' => 'Detalhes: ' . $e->getMessage()
        ];
    }

    header('Location: ?page=registrosGrupos');
    exit;
}

?>


<h1>Cadastrar novo grupo</h1>

<form action="?page=cadastrarGrupos" method="POST">
    <input type="hidden" name="acao" value="cadastrarGrupos">

    <div class="mb-3">
        <label for="nome" class="form-label fw-bold">Nome do Grupo</label>
        <input type="text" name="nome" id="nome" required class="form-control" placeholder="Digite o nome do grupo">
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
        <input type="submit" name="submit" id="submit" value="Criar Grupo" class="btn btn-success px-4">
    </div>
</form>