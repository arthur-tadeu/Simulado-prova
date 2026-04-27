<?php
session_start();
require_once("../../conection.php");

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "DELETE FROM produtos WHERE id=$id";
    
    if(mysqli_query($con, $sql)){
        header("Location: ../paginas/cadastro_produto.php");
    } else {
        echo "Erro ao excluir: " . mysqli_error($con);
    }
}
?>
