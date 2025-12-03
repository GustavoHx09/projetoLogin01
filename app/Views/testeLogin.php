<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SystLog01</title>

    <!-- Bootstrap CSS -->
    <link href="/<?= $_ENV['BASE_URL']; ?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap JS -->
    <script src="/<?= $_ENV['BASE_URL']; ?>/assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100 bg-light">
        <div class="card p-4 shadow-lg" style="max-width: 380px; width: 100%;">
        
            <h3 class="text-center mb-4">Faça o Login</h3>

            <form action="/<?= $_ENV['BASE_URL'] ?>/login" method="POST">
                
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" class="form-control" id="email" 
                        name="email" placeholder="Digite seu e-mail">
                </div>

                <!-- Senha -->
                <div class="mb-4">
                    <label for="senha" class="form-label fw-semibold">Senha</label>
                    <input type="password" class="form-control" id="senha" 
                        name="senha" placeholder="Digite sua senha">
                </div>

                <!-- Botão -->
                <button type="submit" name="submit" class="btn btn-primary w-100">
                    Entrar
                </button>

            </form>
        </div>
    </div>

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
