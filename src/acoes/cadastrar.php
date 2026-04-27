<?php
require_once("../../conection.php");
if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];

    $sql_cadastrar = "INSERT INTO usuarios (nome, senha) VALUES ('$nome','$senha')";
    if(mysqli_query($con,$sql_cadastrar)){
        echo"dwu cwerto cadastro";
    }else{
    echo"deu errado";
    }

}

?>