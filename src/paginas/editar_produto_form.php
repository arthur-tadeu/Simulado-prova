<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php");
    exit();
}
require_once("../../conection.php");

if (!isset($_GET['id'])) {
    header("Location: cadastro_produto.php");
    exit();
}

$id = (int)$_GET['id'];
$sql = "SELECT * FROM produtos WHERE id = $id";
$res = mysqli_query($con, $sql);
$produto = mysqli_fetch_assoc($res);

if (!$produto) {
    header("Location: cadastro_produto.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <nav>
        <span>Editar Produto</span>
        <a href="cadastro_produto.php">Cancelar</a>
    </nav>

    <div class="container" style="max-width: 500px;">
        <div class="card">
            <h3>Alterar Dados</h3>
            <form action="../acoes/editar_produto.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
                
                <label>Nome:</label>
                <input type="text" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
                
                <label>Especificações:</label>
                <textarea name="especificacoes" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"><?php echo htmlspecialchars($produto['especificacoes']); ?></textarea>
                
                <label>Estoque Mínimo:</label>
                <input type="number" name="estoque_minimo" value="<?php echo $produto['estoque_minimo']; ?>" required>
                
                <button type="submit" class="btn btn-blue btn-full">Salvar Alterações</button>
            </form>
        </div>
    </div>
</body>
</html>
