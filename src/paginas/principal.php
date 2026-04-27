<?php
session_start();
if (!isset($_SESSION['usuario_id'])) { header("Location: ../../index.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Menu Principal</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; margin: 0; }
        nav { background: #343a40; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; text-decoration: none; background: #dc3545; padding: 6px 14px; border-radius: 4px; }
        .container { max-width: 600px; margin: 40px auto; }
        .card { background: white; padding: 20px 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 15px; }
        .card h3 { margin: 0 0 8px 0; }
        .card a { display: inline-block; margin-top: 10px; background: #007bff; color: white; padding: 8px 18px; border-radius: 4px; text-decoration: none; }
        .card a:hover { background: #0056b3; }
    </style>
</head>
<body>
    <nav>
        <span>Bem-vindo, <strong><?php echo $_SESSION['usuario_nome']; ?></strong></span>
        <a href="../acoes/logout.php">Sair</a>
    </nav>
    <div class="container">
        <h2>Painel de Controle</h2>
        <div class="card">
            <h3>Cadastro de Produtos</h3>
            <p>Adicione, edite ou remova produtos do sistema.</p>
            <a href="cadastro_produto.php">Acessar</a>
        </div>
        <div class="card">
            <h3>Gestão de Estoque</h3>
            <p>Registre entradas e saídas de estoque.</p>
            <a href="gestao_estoque.php">Acessar</a>
        </div>
    </div>
</body>
</html>