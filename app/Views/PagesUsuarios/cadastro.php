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

<?php include(__DIR__ . '/../menu.php'); ?>
            <li class="nav-item">
                <a class="nav-link" href="/<?= $_ENV['BASE_URL']; ?>/users/new">Cadastrar Usuário</a>
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
    <h1>Cadastrar novo usuario</h1>
    
    <form action="/<?= $_ENV['BASE_URL'] ?>/users/new" method="POST">

        <div class="mb-3">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="email">E-mail</label>
            <input type="text" name="email" id="email" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="usuario">Usuário</label>
            <input type="text" name="usuario" id="usuario" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="grupo" class="form-label fw-semibold">Grupo do Usuário:</label>
            <select id="id_grupo" name="id_grupo" class="form-select border-primary shadow-sm" required>
                <option value="">--Selecione--</option>
                <?php foreach ($grupos as $grupo): ?>
                    <option value="<?= $grupo['id'] ?>"><?= htmlspecialchars($grupo['grupo']) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="form-text text-muted">
                Escolha o grupo que define as permissões do usuário.
            </div>
            <div>

                <div class="mb-3">
                    <input type="submit" name="submit" id="submit" value="Criar usuário" class="btn btn-success">
                </div>
    </form>
</main>