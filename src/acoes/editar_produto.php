<?php
session_start();
require_once("../../conection.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $estoque_minimo = $_POST["estoque_minimo"];

    $sql = "UPDATE produtos SET nome='$nome', estoque_minimo=$estoque_minimo WHERE id=$id";
    
    if(mysqli_query($con, $sql)){
        header("Location: ../paginas/cadastro_produto.php");
    } else {
        echo "Erro ao atualizar: " . mysqli_error($con);
    }
}
?>
