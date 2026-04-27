<?php
session_start();
require_once("../../conection.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = mysqli_real_escape_string($con, $_POST["nome"]);
    $especificacoes = mysqli_real_escape_string($con, $_POST["especificacoes"]);
    $estoque_minimo = (int)$_POST["estoque_minimo"];

    $sql = "INSERT INTO produtos (nome, especificacoes, estoque_minimo, estoque_atual) 
            VALUES ('$nome', '$especificacoes', $estoque_minimo, 0)";
    
    if(mysqli_query($con, $sql)){
        header("Location: ../paginas/cadastro_produto.php");
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($con);
    }
}
?>
