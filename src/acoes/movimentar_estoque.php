<?php
session_start();
require_once("../../conection.php");

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $produto_id = (int)$_POST["produto_id"];
    $usuario_id = (int)$_SESSION["usuario_id"];
    $tipo = $_POST["tipo"];
    $quantidade = (int)$_POST["quantidade"];
    $data = $_POST["data_movimentacao"];

    // 1. Busca dados do produto para verificação do estoque atual e mínimo
    $sql_prod = "SELECT nome, estoque_atual, estoque_minimo FROM produtos WHERE id = $produto_id";
    $res_prod = mysqli_query($con, $sql_prod);
    
    if (!$res_prod) {
        $_SESSION['msg_estoque'] = "Erro: Produto não encontrado! " . mysqli_error($con);
        header("Location: ../paginas/gestao_estoque.php");
        exit();
    }
    
    $produto = mysqli_fetch_assoc($res_prod);

    // 2. Calcula novo estoque
    if ($tipo == 'entrada') {
        $novo_estoque = $produto['estoque_atual'] + $quantidade;
    } else {
        $novo_estoque = $produto['estoque_atual'] - $quantidade;
    }

    // Validação de estoque negativo
    if ($novo_estoque < 0) {
        $_SESSION['msg_estoque'] = "Erro: Estoque insuficiente para essa saída!";
        header("Location: ../paginas/gestao_estoque.php");
        exit();
    }

    // 3. Registra movimentação (ajusta data para DATETIME)
    $data_completa = $data . " " . date('H:i:s'); // Usa a hora atual para ser mais preciso
    $sql_mov = "INSERT INTO movimentacoes (produto_id, usuario_id, tipo, quantidade, data_movimentacao) 
                VALUES ($produto_id, $usuario_id, '$tipo', $quantidade, '$data_completa')";
    
    if (!mysqli_query($con, $sql_mov)) {
        $_SESSION['msg_estoque'] = "Erro ao registrar histórico: " . mysqli_error($con);
        header("Location: ../paginas/gestao_estoque.php");
        exit();
    }

    // 4. Atualiza estoque do produto
    $sql_upd = "UPDATE produtos SET estoque_atual = $novo_estoque WHERE id = $produto_id";

    if(mysqli_query($con, $sql_upd)){
        if($tipo == 'saida' && $novo_estoque < $produto['estoque_minimo']){
            $_SESSION['msg_estoque'] = "Alerta: O produto " . $produto['nome'] . " está abaixo do estoque mínimo! Novo estoque: $novo_estoque";
        } else {
            $_SESSION['msg_estoque'] = "Movimentação registrada com sucesso! Novo estoque: $novo_estoque";
        }
    } else {
        $_SESSION['msg_estoque'] = "Erro ao atualizar estoque: " . mysqli_error($con);
    }

    header("Location: ../paginas/gestao_estoque.php");
    exit();
}
?>
