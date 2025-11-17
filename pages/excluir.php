<?php

include_once('pdo.php');

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

    try {
        // faz a exclusão do usuário no banco de dados
        $sql = "DELETE FROM usuarios 
                WHERE id = " . $_REQUEST['id'];
        $result = $conn->query($sql);
        $result->execute();

        // se deu certo cria um alerta de sucesso
        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Exclusão realizada com sucesso!',
            'text' => "O usuário foi deletado."
        ];
    } catch (PDOException $e) {
        // se deu errado cria um alerta de erro
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Erro ao deletar dados!',
            'text' => 'Detalhes: ' . $e->getMessage()
        ];
    }

    header('Location: ?page=registrosUsuarios');
    exit;
?>