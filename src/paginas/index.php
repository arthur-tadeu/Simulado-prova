<?php
session_start();
require_once("./conection.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <h2>Login</h2>
            <?php if(isset($_SESSION['erro'])): ?>
                <div class="erro"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></div>
            <?php endif; ?>
            <form method="POST" action="src/acoes/autentificar.php">
                <label>Usuário:</label>
                <input type="text" name="nome" required>
                <label>Senha:</label>
                <input type="password" name="senha" required>
                <button type="submit" class="btn btn-blue">Entrar</button>
                <a href="src/paginas/cadastro.php">Ainda não tem conta? Cadastre-se</a>
            </form>
        </div>
    </div>
</body>
</html>