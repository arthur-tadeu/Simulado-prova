<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php");
    exit();
}
require_once("../../conection.php");

$busca = isset($_GET['busca']) ? $_GET['busca'] : '';
$sql = "SELECT * FROM produtos WHERE nome LIKE '%$busca%'";
$query_produtos = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h2>Cadastro de Produtos</h2>
    <a href="principal.php">Voltar ao Menu</a>
    <hr>

    <h3>Novo Produto</h3>
    <form action="../acoes/cadastrar_produto.php" method="POST">
        Nome: <input type="text" name="nome" required>
        Estoque Mín: <input type="number" name="estoque_minimo" required>
        <button type="submit">Cadastrar</button>
    </form>

    <hr>

    <form method="GET">
        Buscar: <input type="text" name="busca" value="<?php echo $busca; ?>">
        <button type="submit">Filtrar</button>
    </form>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Mínimo</th>
            <th>Atual</th>
            <th>Ações</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($query_produtos)): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['estoque_minimo']; ?></td>
            <td><?php echo $row['estoque_atual']; ?></td>
            <td>
                <a href="../acoes/excluir_produto.php?id=<?php echo $row['id']; ?>">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
