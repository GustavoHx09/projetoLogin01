<?php

include_once('includes/pdo.php');

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

if (isset($_POST['submit'])) {

    // recebe os dados do form. e guarda nas variáveis ja passando a senha com hash
    $nome = ($_POST['nome']);
    $email = ($_POST['email']);
    $hash = password_hash(($_POST['senha']), PASSWORD_DEFAULT);
    $id_grupo = ($_POST['id_grupo']);

    try {
        // faz a edição do usuário no banco de dados
        $ins_data = "UPDATE usuarios SET 
                            nome = '{$nome}',
                            email = '{$email}',
                            senha = '{$hash}',
                            fk_grupo = '{$id_grupo}'
                    WHERE id = " . $_REQUEST['id'];
        $stmt_ins = $conn->prepare($ins_data);
        $stmt_ins->execute();

        // se deu certo cria um alerta de sucesso
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Edição realizada com sucesso!',
            'text' => "O usuário $nome foi alterado."
        ];
    } catch (PDOException $e) {
        // se deu errado um alerta de erro
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Erro ao atualizar dados!',
            'text' => 'Detalhes: ' . $e->getMessage()
        ];
    }
    header('Location: ?page=registrosUsuarios');
    exit;
}
?>

<h1>Editar Usuario</h1>
<?php
$sql = "SELECT * FROM usuarios WHERE id =" . $_REQUEST['id'];
$result = $conn->query($sql);
$row = $result->fetch(PDO::FETCH_OBJ);
?>

<?php

$sql = "SELECT id, nome FROM grupos ORDER BY nome";
$stmt = $conn->prepare($sql);
$stmt->execute();
$grupos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form action="?page=editar" method="POST">

    <input type="hidden" name="id" value="<?php echo $row->id; ?>">

    <div class="mb-3">
        <label for="nome">Nome</label>
        <input type="text" value="<?php echo $row->nome; ?>" name="nome" id="nome" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="email">E-mail</label>
        <input type="text" value="<?php echo $row->email; ?>" name="email" id="email" required class="form-control">
    </div>

    <div class="mb-3">
        <label for="senha">Senha</label>
        <input type="password" value="<?php echo $row->senha; ?>" name="senha" id="senha" required class="form-control">
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
        <input type="submit" name="submit" id="submit" value="Concluir edição" class="btn btn-success">
    </div>



</form>