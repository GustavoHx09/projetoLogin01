<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="/<?= $_ENV['BASE_URL']; ?>/assets/css/bootstrap.min.css">
    <script src="/<?= $_ENV['BASE_URL']; ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

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
    <h1>Cadastrar Grupo</h1>
    <form action="/<?= $_ENV['BASE_URL']; ?>/grupos/new" method="POST">

        <div class="mb-3">
            <label for="grupo" class="form-label fw-bold">Nome do Grupo</label>
            <input type="text" name="grupo" id="grupo" class="form-control" placeholder="Digite o nome do grupo">
        </div>
        <div>
            <div class="col-md-6">
                <h4 class="mb-3">Permissões</h4>

                <!-- Cadastrar -->
                <div class="form-check form-switch">                
                    <label for="cadastrar" class="form-check-label mr-3">Cadastrar:</label>
                    <input type="checkbox" class="form-check-input" id="cadastrar" name="cadastrar" value="cadastrar">
                </div>

                <!-- Listar -->
                <div class="form-check form-switch">                
                    <label for="listar" class="form-check-label mr-3">Listar:</label>
                    <input type="checkbox" class="form-check-input" id="listar" name="listar" value="listar">
                </div>

                <!-- Editar -->               
                <div class="form-check form-switch">                
                    <label for="editar" class="form-check-label mr-3">Editar:</label>
                    <input type="checkbox" class="form-check-input" id="editar" name="editar" value="editar">
                </div>

                <!-- Excluir -->
                <div class="form-check form-switch">                
                    <label for="deletar" class="form-check-label mr-3">Deletar:</label>
                    <input type="checkbox" class="form-check-input" id="deletar" name="deletar" value="deletar">
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <input type="submit" value="Criar Grupo" class="btn btn-success px-4">
        </div>
    </form>

    <?php
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
    ?>

</main>