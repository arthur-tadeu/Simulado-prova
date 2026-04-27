<?php
session_start();
require_once("../../conection.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

    // Verifica se já existe um usuário com esse nome
    $sql_check = "SELECT id FROM usuarios WHERE nome = '$nome'";
    $res_check = mysqli_query($con, $sql_check);

    if(mysqli_num_rows($res_check) > 0){
        $_SESSION['erro'] = "Este nome de usuário já está em uso!";
        header("Location: ../paginas/cadastro.php");
    } else {
        $sql = "INSERT INTO usuarios (nome, senha) VALUES ('$nome', '$senha')";
        
        if(mysqli_query($con, $sql)){
            // Cadastro com sucesso, volta para a tela de login
            $_SESSION['erro'] = "Conta criada com sucesso! Faça o login."; // Usando a mesma variável de msg do login
            header("Location: ../../index.php");
        } else {
            echo "Erro ao cadastrar: " . mysqli_error($con);
        }
    }
}
?>
