<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); width: 300px; }
        h2 { text-align: center; margin-bottom: 20px; }
        input { width: 100%; padding: 8px; margin: 6px 0 14px 0; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 15px; }
        button:hover { background: #1e7e34; }
        .erro { color: red; background: #ffe0e0; padding: 8px; border-radius: 4px; margin-bottom: 10px; text-align: center; }
        a { display: block; text-align: center; margin-top: 12px; color: #007bff; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Criar Conta</h2>
        <?php if(isset($_SESSION['erro'])): ?>
            <div class="erro"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
        <?php endif; ?>
        <form method="POST" action="../acoes/cadastrar_usuario.php">
            <label>Nome de Usuário:</label>
            <input type="text" name="nome" required>
            <label>Senha:</label>
            <input type="password" name="senha" required>
            <button type="submit">Cadastrar</button>
            <a href="../../index.php">Já tem conta? Faça login</a>
        </form>
    </div>
</body>
</html>