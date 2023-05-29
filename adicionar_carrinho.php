<?php
session_start();

if (isset($_GET['idProduto'])) {
    $idProduto = intval($_GET['idProduto']);
    adicionarAoCarrinho($idProduto);
}

function adicionarAoCarrinho($idProduto)
{
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    if (array_key_exists($idProduto, $_SESSION['carrinho'])) {
        $_SESSION['carrinho'][$idProduto]++;
    } else {
        $_SESSION['carrinho'][$idProduto] = 1;
    }
}

http_response_code(204);
exit;
