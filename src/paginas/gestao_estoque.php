<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../../index.php"); exit(); }
require_once("../../conection.php");

// Pega a mensagem ANTES de gerar HTML
$msg = isset($_SESSION['msg_estoque']) ? $_SESSION['msg_estoque'] : '';
unset($_SESSION['msg_estoque']);

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
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <nav>
        <span>Gestão de Estoque</span>
        <a href="principal.php">Voltar ao Menu</a>
    </nav>

    <div class="container">
        <?php if($msg !== ''): 
            $classe = (strpos($msg, 'Alerta') !== false || strpos($msg, 'Erro') !== false) ? 'msg-erro' : 'msg-sucesso';
        ?>
            <div class="<?php echo $classe; ?>"><?php echo $msg; ?></div>
        <?php endif; ?>

        <div class="grid-2">
            <div class="card">
                <h3>Status do Estoque</h3>
                <table>
                    <tr><th>ID</th><th>Produto</th><th>Atual</th><th>Mín.</th></tr>
                    <?php foreach($produtos as $p): ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td><?php echo $p['nome']; ?></td>
                        <td class="<?php echo ($p['estoque_atual'] < $p['estoque_minimo']) ? 'baixo' : ''; ?>">
                            <?php echo $p['estoque_atual']; ?>
                        </td>
                        <td><?php echo $p['estoque_minimo']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>

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

                    <button type="submit" class="btn btn-blue btn-full">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
