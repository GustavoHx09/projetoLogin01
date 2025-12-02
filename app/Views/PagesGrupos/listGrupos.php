<?php include(__DIR__ . '/../menu.php'); ?>
            <li class="nav-item">
                <a class="nav-link" href="grupos/new">Cadastrar Grupos</a>
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
    <h1>Registros de Grupos</h1>

    <?php
        echo "<table class='table table-hover table-striped table-bordered'>
            <tr>
                <th>Grupo</th>
                <th>Cadastrar</th>
                <th>Listar</th>
                <th>Atualizar</th>
                <th>Deletar</th>
                <th>Ações</th>
            </tr>";
        if (empty($result)) {
            echo "<tr>
                    <td colspan='6'>Nenhum dado encontrado</td>
                </tr>";
        } else {
            foreach ($result as $grupo) {
                    $cadastrar = ($grupo['cadastrar']) ? "Sim" : "Não";
                    $listar = ($grupo['listar']) ? "Sim" : "Não";
                    $editar = ($grupo['editar']) ? "Sim" : "Não";
                    $deletar = ($grupo['deletar']) ? "Sim" : "Não";
                echo "<tr>
                        <td>" . $grupo['grupo'] . "</td>
                        <td>" . $cadastrar . "</td>
                        <td>" . $listar . "</td>
                        <td>" . $editar . "</td>
                        <td>" . $deletar . "</td>
                        <td >
                            <a href='/" . $_ENV['BASE_URL'] . "/grupos/edit/" . $grupo['id'] . "' class='btn btn-primary'>
                            <i class='fas fa-edit'></i> Editar</a>

                            <form action='/" . $_ENV['BASE_URL'] . "/grupos/delete/" . $grupo['id'] . "' method='POST' style='display:inline;'>
                                <button type='submit' class='btn btn-danger' onclick=\"return confirm('Tem certeza que deseja excluir o grupo " . $grupo['grupo'] . "?');\"><i class='fas fa-trash-alt'></i> Excluir</button>
                            </form>
                        </td>
                <tr>";
            }
        }
        echo "</table>";
    ?>
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