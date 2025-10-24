<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema - Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Style css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="login-card text-center">
        <h1>Faça o Login</h1>
        <form action="includes/testeLogin.php" method="POST">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Digite seu e-mail" required>
            </div>

            <div class="mb-4 text-start">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
            </div>

            <button type="submit" name="submit" class="btn btn-custom">Entrar</button>

            <p class="mt-4 mb-0">Não tem cadastro? <u>Sobe um chamado lá!</u></p>
        </form>
    </div>

    <!-- SweetAlert erro -->
    <?php
    if (isset($_GET['erro']) && $_GET['erro'] === 'login') {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro ao fazer login',
            text: 'Email ou senha inválidos!',
            confirmButtonText: 'OK'
        });
        </script>
        ";
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
