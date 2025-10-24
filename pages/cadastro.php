<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

include_once('includes/pdo.php');

if (isset($_POST['submit'])) {

    $nome = ($_POST['nome']);
    $email = ($_POST['email']);
    $hash = password_hash(($_POST['senha']), PASSWORD_DEFAULT);
    $id_grupo = ($_POST['id_grupo']);

    try {
        $ins_data = "INSERT INTO usuarios 
                                (nome, email, senha, fk_grupo) 
                        VALUES  ('$nome', '$email', '$hash', '$id_grupo')";
        $stmt_ins = $conn->prepare($ins_data);
        $stmt_ins->execute();

        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Cadastro realizado com sucesso!',
            'text' => "O usuário $nome foi inserido no banco de dados."
        ];
    } catch (PDOException $e) {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Erro ao cadastrar!',
            'text' => 'Detalhes: ' . $e->getMessage()
        ];
    }

    header('Location: ?page=registrosUsuarios');
    exit;
}

?>


<h1>Cadastrar novo usuario</h1>

<?php

$sql = "SELECT id, nome FROM grupos ORDER BY nome";
$stmt = $conn->prepare($sql);
$stmt->execute();
$grupos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form action="?page=cadastrar" method="POST">

    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" required class="form-control">
    </div>
    
    <div class="mb-3">
    <label for="grupo"  class="form-label fw-semibold">Grupo do Usuário:</label>
        <select id="id_grupo" name="id_grupo"  class="form-select border-primary shadow-sm" required>
        <option value="">--Selecione--</option>
        <?php foreach ($grupos as $grupo): ?>
            <option value="<?= $grupo['id'] ?>"><?= htmlspecialchars($grupo['nome']) ?></option>
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