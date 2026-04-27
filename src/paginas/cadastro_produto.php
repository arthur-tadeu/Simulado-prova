<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../../index.php"); exit(); }
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
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <nav>
        <span>Cadastro de Produtos</span>
        <a href="principal.php">Voltar ao Menu</a>
    </nav>

    <div class="container">
        <div class="card">
            <h3>Novo Produto</h3>
            <form action="../acoes/cadastrar_produto.php" method="POST" class="form-inline" onsubmit="return validar(this)">
                <input type="text" name="nome" placeholder="Nome do produto" required>
                <input type="number" name="estoque_minimo" placeholder="Estoque mínimo" min="1" required>
                <button type="submit" class="btn btn-green">Cadastrar</button>
            </form>
        </div>

        <div class="card">
            <h3>Produtos Cadastrados</h3>
            <form method="GET" class="form-inline">
                <input type="text" name="busca" placeholder="Buscar produto..." value="<?php echo htmlspecialchars($busca); ?>">
                <button type="submit" class="btn btn-blue">Buscar</button>
            </form>

            <table>
                <tr><th>ID</th><th>Nome</th><th>Mín.</th><th>Atual</th><th>Ações</th></tr>
                <?php while($row = mysqli_fetch_assoc($query_produtos)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['estoque_minimo']; ?></td>
                    <td><?php echo $row['estoque_atual']; ?></td>
                    <td>
                        <a href="../acoes/excluir_produto.php?id=<?php echo $row['id']; ?>" class="btn btn-red" onclick="return confirm('Excluir este produto?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>

    <script>
        function validar(form) {
            if (form.nome.value.trim() === "") { alert("Informe o nome do produto!"); return false; }
            if (form.estoque_minimo.value <= 0) { alert("Estoque mínimo deve ser maior que 0!"); return false; }
            return true;
        }
    </script>
</body>
</html>
