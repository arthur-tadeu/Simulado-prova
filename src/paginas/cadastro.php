<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <h2>Criar Conta</h2>
            <?php if(isset($_SESSION['erro'])): ?>
                <div class="erro"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
            <?php endif; ?>
            <form method="POST" action="../acoes/cadastrar_usuario.php">
                <label>Nome de Usuário:</label>
                <input type="text" name="nome" required>
                <label>Senha:</label>
                <input type="password" name="senha" required>
                <button type="submit" class="btn btn-green">Cadastrar</button>
                <a href="../../index.php">Já tem conta? Faça login</a>
            </form>
        </div>
    </div>
</body>
</html>