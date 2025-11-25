<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="/<?= $_ENV['BASE_URL']; ?>/assets/css/bootstrap.min.css">
    <script src="/<?= $_ENV['BASE_URL']; ?>/assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- chama a parte fixa da navbar -->
    <?php include(__DIR__."/menu.php"); ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="/<?= $_ENV['BASE_URL']; ?>/logout" class="btn btn-danger">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</body>

</html>