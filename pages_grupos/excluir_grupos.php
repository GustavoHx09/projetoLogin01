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

    try {

        $sql = "DELETE FROM grupos WHERE id = " . $_REQUEST['id'];
        $result = $conn->query($sql);
        $result->execute();

        $_SESSION['alert'] = [
            'icon' => 'success',
            'title' => 'Exclusão realizada com sucesso!',
            'text' => "O grupo foi deletado."
        ];
    } catch (PDOException $e) {
        $_SESSION['alert'] = [
            'icon' => 'error',
            'title' => 'Erro ao deletar dados!',
            'text' => 'Detalhes: ' . $e->getMessage()
        ];
    }

    header('Location: ?page=registrosGrupos');
    exit;
?>