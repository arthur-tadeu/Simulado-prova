<?php
session_start();
require_once("./conection.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Acesso ao Sistema</h2>
    <?php if(isset($_SESSION['erro'])): ?>
        <p style="color:red"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
    <?php endif; ?>

    <form method="POST" action="src/acoes/autentificar.php">
        <label>Usuário:</label><br>
        <input type="text" name="nome" required><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>
        <button type="submit">Entrar</button>
        <br><br>
        <a href="src/paginas/cadastro.php">Crie sua conta</a>
    </form>
</body>
</html>