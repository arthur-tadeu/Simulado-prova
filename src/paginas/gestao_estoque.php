<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../../index.php"); exit(); }
require_once("../../conection.php");

$sql = "SELECT * FROM produtos ORDER BY nome ASC";
$result = mysqli_query($con, $sql);
$produtos = [];
while ($row = mysqli_fetch_assoc($result)) { $produtos[] = $row; }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Estoque</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 0; }
        nav { background: #343a40; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; background: #6c757d; padding: 6px 14px; border-radius: 4px; }
        .container { max-width: 900px; margin: 30px auto; display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h3 { border-bottom: 2px solid #007bff; padding-bottom: 8px; margin-top: 0; }
        label { display: block; margin: 10px 0 4px; font-weight: bold; }
        select, input { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; margin-top: 15px; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
        button:hover { background: #0056b3; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #343a40; color: white; padding: 9px; text-align: left; }
        td { padding: 8px 9px; border-bottom: 1px solid #eee; }
        .baixo { color: #dc3545; font-weight: bold; }
    </style>
</head>
<body>
    <nav>
        <span>Gestão de Estoque</span>
        <a href="principal.php">Voltar ao Menu</a>
    </nav>

    <div class="container">
        <!-- Tabela de produtos -->
        <div class="card">
            <h3>Status do Estoque</h3>
            <table>
                <tr><th>Produto</th><th>Atual</th><th>Mín.</th></tr>
                <?php foreach($produtos as $p): ?>
                <tr>
                    <td><?php echo $p['nome']; ?></td>
                    <td class="<?php echo ($p['estoque_atual'] < $p['estoque_minimo']) ? 'baixo' : ''; ?>">
                        <?php echo $p['estoque_atual']; ?>
                    </td>
                    <td><?php echo $p['estoque_minimo']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <!-- Formulário de movimentação -->
        <div class="card">
            <h3>Registrar Movimentação</h3>
            <form action="../acoes/movimentar_estoque.php" method="POST">
                <label>Produto:</label>
                <select name="produto_id" required>
                    <?php foreach($produtos as $p): ?>
                    <option value="<?php echo $p['id']; ?>"><?php echo $p['nome']; ?></option>
                    <?php endforeach; ?>
                </select>

                <label>Tipo:</label>
                <select name="tipo">
                    <option value="entrada">Entrada</option>
                    <option value="saida">Saída</option>
                </select>

                <label>Quantidade:</label>
                <input type="number" name="quantidade" min="1" required>

                <label>Data:</label>
                <input type="date" name="data_movimentacao" value="<?php echo date('Y-m-d'); ?>" required>

                <button type="submit">Registrar</button>
            </form>
        </div>
    </div>

    <?php if(isset($_SESSION['msg_estoque'])): ?>
        <script>alert("<?php echo $_SESSION['msg_estoque']; ?>");</script>
        <?php unset($_SESSION['msg_estoque']); ?>
    <?php endif; ?>
</body>
</html>
