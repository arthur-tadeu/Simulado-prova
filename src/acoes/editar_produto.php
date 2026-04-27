<?php
session_start();
require_once("../../conection.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = (int)$_POST["id"];
    $nome = mysqli_real_escape_string($con, $_POST["nome"]);
    $especificacoes = mysqli_real_escape_string($con, $_POST["especificacoes"]);
    $estoque_minimo = (int)$_POST["estoque_minimo"];

    $sql = "UPDATE produtos SET nome='$nome', especificacoes='$especificacoes', estoque_minimo=$estoque_minimo WHERE id=$id";
    
    if(mysqli_query($con, $sql)){
        header("Location: ../paginas/cadastro_produto.php");
    } else {
        echo "Erro ao atualizar: " . mysqli_error($con);
    }
}
?>
