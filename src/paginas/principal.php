<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Menu Principal</title>
</head>
<body>
    <h1>Sistema GS Eletrônicos</h1>
    <p>Bem-vindo, <strong><?php echo $_SESSION['usuario_nome']; ?></strong> | <a href="../acoes/logout.php">Sair</a></p>
    
    <hr>
    
    <ul>
        <li><a href="cadastro_produto.php">Cadastro de Produtos</a></li>
        <li><a href="gestao_estoque.php">Gestão de Estoque</a></li>
    </ul>
</body>
</html>