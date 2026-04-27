<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta</title>
</head>
<body>
    <h2>Criar Nova Conta</h2>
    <?php if(isset($_SESSION['erro'])): ?>
        <p style="color:red"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
    <?php endif; ?>
    <form method="POST" action="../acoes/cadastrar_usuario.php">
        <label>Nome de Usuário:</label><br>
        <input type="text" name="nome" required><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>
        <button type="submit">Cadastrar</button>
        <br><br>
        <a href="../../index.php">Voltar para o Login</a>
    </form>
</body>
</html>