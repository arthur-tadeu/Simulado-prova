<?php
session_start();
require_once("../../conection.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = $_POST["nome"];
    $estoque_minimo = $_POST["estoque_minimo"];

    // Removido 'especificacoes' para simplificar o sistema
    $sql = "INSERT INTO produtos (nome, estoque_minimo, estoque_atual) VALUES ('$nome', $estoque_minimo, 0)";
    
    if(mysqli_query($con, $sql)){
        header("Location: ../paginas/cadastro_produto.php");
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($con);
    }
}
?>
