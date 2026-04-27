<?php
session_start();
require_once("../../conection.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $produto_id = $_POST["produto_id"];
    $usuario_id = $_SESSION["usuario_id"];
    $tipo = $_POST["tipo"];
    $quantidade = $_POST["quantidade"];
    $data = $_POST["data_movimentacao"];

    // 1. Busca dados do produto
    $sql_prod = "SELECT nome, estoque_atual, estoque_minimo FROM produtos WHERE id = $produto_id";
    $res_prod = mysqli_query($con, $sql_prod);
    $produto = mysqli_fetch_assoc($res_prod);

    // 2. Calcula novo estoque
    $novo_estoque = ($tipo == 'entrada') ? $produto['estoque_atual'] + $quantidade : $produto['estoque_atual'] - $quantidade;

    if ($novo_estoque < 0) {
        $_SESSION['msg_estoque'] = "Erro: Estoque insuficiente para essa saída!";
        header("Location: ../paginas/gestao_estoque.php");
        exit();
    }

    // 3. Registra movimentação (ajusta data para DATETIME)
    $data_completa = $data . " 00:00:00";
    $sql_mov = "INSERT INTO movimentacoes (produto_id, usuario_id, tipo, quantidade, data_movimentacao) 
                VALUES ($produto_id, $usuario_id, '$tipo', $quantidade, '$data_completa')";
    mysqli_query($con, $sql_mov);

    // 4. Atualiza estoque do produto
    $sql_upd = "UPDATE produtos SET estoque_atual = $novo_estoque WHERE id = $produto_id";

    if(mysqli_query($con, $sql_upd)){
        if($tipo == 'saida' && $novo_estoque < $produto['estoque_minimo']){
            $_SESSION['msg_estoque'] = "Alerta: O produto " . $produto['nome'] . " está abaixo do estoque mínimo!";
        } else {
            $_SESSION['msg_estoque'] = "Movimentação registrada com sucesso!";
        }
    } else {
        $_SESSION['msg_estoque'] = "Erro ao processar movimentação.";
    }

    header("Location: ../paginas/gestao_estoque.php");
}
?>
