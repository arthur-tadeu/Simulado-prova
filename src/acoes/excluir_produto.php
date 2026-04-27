<?php
session_start();
require_once("../../conection.php");

if(isset($_GET["id"])){
    $id = $_GET["id"];

    // Primeiro apaga as movimentações relacionadas ao produto
    mysqli_query($con, "DELETE FROM movimentacoes WHERE produto_id = $id");

    // Depois apaga o produto
    if(mysqli_query($con, "DELETE FROM produtos WHERE id = $id")){
        header("Location: ../paginas/cadastro_produto.php");
    } else {
        echo "Erro ao excluir: " . mysqli_error($con);
    }
}
?>
