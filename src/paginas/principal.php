<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../../index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Menu Principal</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <nav>
        <span>Bem-vindo, <strong><?php echo $_SESSION['usuario_nome']; ?></strong></span>
        <a href="../acoes/logout.php">Sair</a>
    </nav>
    <div class="container">
        <h2>Painel de Controle</h2>
        <div class="menu-grid">
            <div class="menu-card">
                <h3>Cadastro de Produtos</h3>
                <p>Adicione, edite ou remova produtos do sistema.</p>
                <a href="cadastro_produto.php" class="btn btn-blue">Acessar</a>
            </div>
            <div class="menu-card">
                <h3>Gestão de Estoque</h3>
                <p>Registre entradas e saídas de estoque.</p>
                <a href="gestao_estoque.php" class="btn btn-blue">Acessar</a>
            </div>
        </div>
    </div>
</body>
</html>