<?php include(__DIR__ . '/../menu.php'); ?>
            <li class="nav-item">
                <a class="nav-link" href="/<?= $_ENV['BASE_URL']; ?>/grupos/new">Cadastrar Grupos</a>
            </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="/<?= $_ENV['BASE_URL']; ?>/logout" class="btn btn-danger">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container align-self-center">
    <h1>Editar Grupo</h1>
    <form action="/<?= $_ENV['BASE_URL']; ?>/grupos/edit/<?= $id; ?>" method="POST">

        <div class="mb-3">
            <label for="grupo" class="form-label fw-bold">Nome do Grupo</label>
            <input type="text" name="grupo" value="<?= $result['grupo'] ?>" id="grupo" class="form-control" placeholder="Digite o nome do grupo">
        </div>

        <div>
            <!-- Permissões -->
            <div class="col-md-6">
                <h4 class="mb-3">Permissões</h4>

                <!-- Cadastrar -->
                <div class="form-check form-switch">                
                    <label for="cadastrar" class="form-check-label mr-3">Cadastrar:</label>
                    <input type="checkbox" class="form-check-input" id="cadastrar" name="cadastrar" value="cadastrar" <?= ($result['cadastrar'] == 1 ? 'checked' : '') ?> >
                </div>

                <!-- Listar -->
                <div class="form-check form-switch">                
                    <label for="listar" class="form-check-label mr-3">Listar:</label>
                    <input type="checkbox" class="form-check-input" id="listar" name="listar" value="listar" <?= ($result['listar'] == 1 ? 'checked' : '') ?> >
                </div>

                <!-- Editar -->               
                <div class="form-check form-switch">                
                    <label for="editar" class="form-check-label mr-3">Editar:</label>
                    <input type="checkbox" class="form-check-input" id="editar" name="editar" value="editar" <?= ($result['editar'] == 1 ? 'checked' : '') ?> >
                </div>

                <!-- Excluir -->
                <div class="form-check form-switch">                
                    <label for="deletar" class="form-check-label mr-3">Deletar:</label>
                    <input type="checkbox" class="form-check-input" id="deletar" name="deletar" value="deletar" <?= ($result['deletar'] == 1 ? 'checked' : '') ?> >
                </div>
            </div>
        </div>

        <div class="mt-4">
            <input type="submit" value="Atualizar Grupo" class="btn btn-success px-4">
        </div>
    </form>
</main>

<?php
if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    echo "
        <script>
        Swal.fire({
            icon: '{$alert['icon']}',
            title: '{$alert['title']}',
            html: '{$alert['text']}',
            confirmButtonText: 'OK'
        });
        </script>
    ";
    unset($_SESSION['alert']);
}
?>

</body>

</html>