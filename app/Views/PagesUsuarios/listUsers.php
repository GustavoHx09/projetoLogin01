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
    <a class="nav-link" href="users/new">Cadastrar Usuário</a>
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
    <h1>Registros de Usuários</h1>


    <?php
    if (count($users) > 0) {
        echo "<table class='table table-hover table-striped table-bordered'>
        <tr>
        <th>#</th>
        <th>Nome</th>
        <th>User</th>
        <th>E-mail</th>
        <th>Grupo</th>
        <th>Ações</th>
        </tr>";
        foreach ($users as $dado) {
            echo "<tr>
                    <td>" . $dado['id'] . "</td>
                    <td>" . $dado['nome'] . "</td>
                    <td>" . $dado['usuario'] . "</td>
                    <td>" . $dado['email'] . "</td>
                    <td>" . $dado['grupo'] . "</td>
                    <td >
                        <a href='/" . $_ENV['BASE_URL'] . "/users/edit/" . $dado['id'] . "' class='btn btn-primary'>
                        <i class='fas fa-edit'></i> Editar</a>

                        <form action='/" . $_ENV['BASE_URL'] . "/users/delete/" . $dado['id'] . "' method='POST' style='display:inline;'>
                            <button type='submit' class='btn btn-danger' 
                            onclick=\"return confirm('Tem certeza que deseja excluir o usuario " . $dado['nome'] . "?');\">
                                <i class='fas fa-trash-alt'></i> Excluir
                            </button>
                        </form>
                    </td>
            <tr>";
        }
        echo "</table>";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro ao buscar registros',
            text: 'Nenhum registro encontrado no banco de dados',
            confirmButtonText: 'OK'
        });
        </script>
        ";
    }
    ?>

</main>