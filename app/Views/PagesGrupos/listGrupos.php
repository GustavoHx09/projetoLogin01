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
<h1>Registros de Grupos</h1>

<?php
// seleciona todos os grupos no banco de dados
$sql = "SELECT * FROM grupos";
$result = $conn->query($sql);
$rows = $result->fetchAll(PDO::FETCH_OBJ);
$qtd = count($rows);

//cria uma lista com os grupos encontrados
if ($qtd > 0) {
    echo "<table class='table table-hover table-striped table-bordered'>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Nome</th>";
    echo "<th>Ações</th>";
    echo "</tr>";
    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . $row->id . "</td>";
        echo "<td>" . $row->nome . "</td>";
        echo "<td>
                <button onclick=\"location.href='?page=editarGrupos&id=" . $row->id . "';\"class='btn btn-success'>Editar</button>

                <button onclick=\"if(confirm('Tem certeza que deseja excluir o banco $row->nome ?')){location.href='?page=excluirGrupos&id=" . $row->id . "';}else{false;}\" class='btn btn-danger'>Excluir</button>
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