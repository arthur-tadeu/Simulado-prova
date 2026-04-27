<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php");
    exit();
}
require_once("../../conection.php");

$sql = "SELECT * FROM produtos ORDER BY nome ASC";
$result = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Estoque</title>
</head>
<body>
    <h2>Gestão de Estoque</h2>
    <a href="principal.php">Voltar ao Menu</a>
    <hr>

    <h3>Movimentação</h3>
    <form action="../acoes/movimentar_estoque.php" method="POST">
        Produto: 
        <select name="produto_id" required>
            <?php while($p = mysqli_fetch_assoc($result)): ?>
                <option value="<?php echo $p['id']; ?>"><?php echo $p['nome']; ?> (<?php echo $p['estoque_atual']; ?>)</option>
            <?php endwhile; ?>
        </select><br><br>
        
        Tipo: 
        <select name="tipo">
            <option value="entrada">Entrada</option>
            <option value="saida">Saída</option>
        </select><br><br>

        Quantidade: <input type="number" name="quantidade" required><br><br>
        Data: <input type="date" name="data_movimentacao" value="<?php echo date('Y-m-d'); ?>"><br><br>

        <button type="submit">Registrar</button>
    </form>

    <?php if(isset($_SESSION['msg_estoque'])): ?>
        <script>alert("<?php echo $_SESSION['msg_estoque']; ?>");</script>
        <?php unset($_SESSION['msg_estoque']); ?>
    <?php endif; ?>
</body>
</html>
