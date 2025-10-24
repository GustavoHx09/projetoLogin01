<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<h1>Registros de Usuários</h1>

<?php

$sql = "SELECT u.id, u.nome, u.email, g.nome AS nome_grupo
        FROM usuarios u
        LEFT JOIN grupos g ON g.id = u.fk_grupo";
$result = $conn->query($sql);
$rows = $result->fetchAll(PDO::FETCH_OBJ);
$qtd = count($rows);

if ($qtd > 0) {
    echo "<table class='table table-hover table-striped table-bordered'>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Nome</th>";
    echo "<th>E-mail</th>";
    echo "<th>Grupo</th>";
    echo "<th>Ações</th>";
    echo "</tr>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row->id . "</td>";
        echo "<td>" . $row->nome . "</td>";
        echo "<td>" . $row->email . "</td>";
        echo "<td>" . $row->nome_grupo . "</td>";
        echo "<td>
                <button onclick=\"location.href='?page=editar&id=" . $row->id . "';\"class='btn btn-success'>Editar</button>

                <button onclick=\"if(confirm('Tem certeza que deseja excluir o usuario $row->nome ?')){location.href='?page=excluir&id=" . $row->id . "';}else{false;}\" class='btn btn-danger'>Excluir</button>
            </td>"; 
       echo "<tr>";
    }
    echo "</table>";
} else {
    echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Erro ao buscar registros',
            text: 'Nenhum registro encontrado no banco de dados',
            confirmButtonText: 'OK'
        });
        </script>
        ";
}
?>