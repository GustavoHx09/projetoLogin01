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

// faz a exclusão do grupo no banco de dados
try {
    $sql = "DELETE FROM grupos 
                WHERE id = " . $_REQUEST['id'];
    $result = $conn->query($sql);
    $result->execute();

    //se deu certo emite um alerta de sucesso
    $_SESSION['alert'] = [
        'icon' => 'success',
        'title' => 'Exclusão realizada com sucesso!',
        'text' => "O grupo foi deletado."
    ];
} catch (PDOException $e) {
    //se deu erro emite um alerta de erro
    $_SESSION['alert'] = [
        'icon' => 'error',
        'title' => 'Erro ao deletar dados!',
        'text' => 'Detalhes: ' . $e->getMessage()
    ];
}

header('Location: ?page=registrosGrupos');
exit;
