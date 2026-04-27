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
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 0; }
        nav { background: #343a40; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; background: #6c757d; padding: 6px 14px; border-radius: 4px; }
        .container { max-width: 900px; margin: 30px auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h3 { border-bottom: 2px solid #007bff; padding-bottom: 8px; }
        input, select { padding: 7px; border: 1px solid #ccc; border-radius: 4px; margin-right: 5px; }
        button, .btn { padding: 7px 15px; border: none; border-radius: 4px; cursor: pointer; color: white; }
        .btn-blue { background: #007bff; } .btn-blue:hover { background: #0056b3; }
        .btn-green { background: #28a745; } .btn-green:hover { background: #1e7e34; }
        .btn-red { background: #dc3545; text-decoration: none; font-size: 13px; padding: 4px 10px; } .btn-red:hover { background: #b02a37; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background: #343a40; color: white; padding: 10px; text-align: left; }
        td { padding: 9px 10px; border-bottom: 1px solid #eee; }
        tr:hover { background: #f8f9fa; }
        .form-inline { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; margin-bottom: 20px; }
    </style>
</head>
<body>
    <nav>
        <span>Cadastro de Produtos</span>
        <a href="principal.php">Voltar ao Menu</a>
    </nav>

    <div class="container">

        <h3>Novo Produto</h3>
        <form action="../acoes/cadastrar_produto.php" method="POST" class="form-inline" onsubmit="return validar(this)">
            <input type="text" name="nome" placeholder="Nome do produto" required>
            <input type="number" name="estoque_minimo" placeholder="Estoque mínimo" min="1" required>
            <button type="submit" class="btn btn-green">Cadastrar</button>
        </form>

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

    <script>
        function validar(form) {
            if (form.nome.value.trim() === "") { alert("Informe o nome do produto!"); return false; }
            if (form.estoque_minimo.value <= 0) { alert("Estoque mínimo deve ser maior que 0!"); return false; }
            return true;
        }
    </script>
</body>
</html>
