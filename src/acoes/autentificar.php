<?php
session_start();
require_once("../../conection.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

    $sql_pegar = "SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";
    $result = mysqli_query($con, $sql_pegar);

    if(mysqli_num_rows($result) > 0){
        $usuario = mysqli_fetch_assoc($result);
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
        header("Location: ../paginas/principal.php");
    } else {
        $_SESSION['erro'] = "Usuário ou senha incorretos!";
        // Redireciona para o index da raiz para manter a consistência do include
        header("Location: ../../index.php");
    }
}
?>