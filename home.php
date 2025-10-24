<?php
session_start();

if (!isset($_SESSION['email']) == true and (!isset($_SESSION['senha']) == true)) {

    session_unset();
    header('Location: index.php');
}
$logado = $_SESSION['nome'];
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Sistema</title>
</head>

<body>

    <?php
    $page = @$_REQUEST["page"];

    //Home
    if ($page == "" || $page == "home") {
    ?>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h2>Sistema</h2>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Início</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=registrosUsuarios">Registros Usuarios</a></li>
                                <li><a class="dropdown-item" href="?page=registrosGrupos">Registro Grupos</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="includes/sair.php" class="btn btn-danger">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php
    }


    //Consulta de Cadastros
    elseif ($page == "registrosUsuarios") {
    ?>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h2>Sistema</h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Início</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=registrosUsuarios">Registro Usuarios</a></li>
                                <li><a class="dropdown-item" href="?page=registrosGrupos">Registro Grupos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=cadastrar">Cadastrar Usuario</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="includes/sair.php" class="btn btn-danger">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <?php
    }

    //Cadastrar Usuario
    elseif ($page == "cadastrar") {
    ?>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h2>Sistema</h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Início</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=registrosUsuarios">Registros Usuarios</a></li>
                                <li><a class="dropdown-item" href="?page=registrosGrupos">Registro Grupos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=cadastrar">Cadastrar Usuario</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="includes/sair.php" class="btn btn-danger">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <?php
    }

    //Editar Usuario
    elseif ($page == "editar") {
    ?>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h2>Sistema</h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Início</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=registrosUsuarios">Registros Usuarios</a></li>
                                <li><a class="dropdown-item" href="?page=registrosGrupos">Registro Grupos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=cadastrar">Cadastrar</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="includes/sair.php" class="btn btn-danger">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <?php
    }

    //Consulta de Grupos
    elseif ($page == "registrosGrupos") {
    ?>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h2>Sistema</h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Início</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=registrosUsuarios">Registro Usuarios</a></li>
                                <li><a class="dropdown-item" href="?page=registrosGrupos">Registro Grupos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=cadastrarGrupos">Cadastrar Grupo</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="includes/sair.php" class="btn btn-danger">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <?php
    }

    //CadastrarGrupo
    elseif ($page == "cadastrarGrupos") {
    ?>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h2>Sistema</h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Início</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=registrosUsuarios">Registro Usuarios</a></li>
                                <li><a class="dropdown-item" href="?page=registrosGrupos">Registro Grupos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=cadastrarGrupos">Cadastrar Grupo</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="includes/sair.php" class="btn btn-danger">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <?php
    }

    //EditarGrupo
    elseif ($page == "editarGrupos") {
    ?>

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <h2>Sistema</h2>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="home.php">Início</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Registros
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="?page=registrosUsuarios">Registro Usuarios</a></li>
                                <li><a class="dropdown-item" href="?page=registrosGrupos">Registro Grupos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=cadastrarGrupos">Cadastrar Grupo</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="includes/sair.php" class="btn btn-danger">Sair</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <?php
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col mt-5">
                <?php
                include_once("includes/pdo.php");
                switch (@$_REQUEST["page"]) {
                    case "registrosUsuarios":
                        include("pages/registrosUsuarios.php");
                        break;
                    case "cadastrar":
                        include("pages/cadastro.php");
                        break;
                    case "editar":
                        include("pages/editar.php");
                        break;
                    case "excluir":
                        include("pages/excluir.php");
                        break;
                    case "registrosGrupos":
                        include("pages_grupos/registros_grupos.php");
                        break;
                    case "cadastrarGrupos":
                        include("pages_grupos/cadastro_grupos.php");
                        break;
                    case "editarGrupos":
                        include("pages_grupos/editar_grupos.php");
                        break;
                    case "excluirGrupos":
                        include("pages_grupos/excluir_grupos.php");
                        break;
                    default:
                        echo "<h1>Bem vindo " . $logado . "</h1>";
                        break;
                }
                ?>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>