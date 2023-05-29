<?php
// Verifique se o ID produto e a nova quantidade foram enviados na solicitação POST
if (isset($_POST['IDproduto']) && isset($_POST['quantidade'])) {
    $idProduto = $_POST['IDproduto'];
    $newQuantity = $_POST['quantidade'];

    // Atualize a quantidade do produto no carrinho
    $cart = $_SESSION['carrinho'];
    foreach ($cart as &$product) {
        if ($product['IDproduto'] == $productId) {
            $product['quantidade'] = $newQuantity;
            $product['total'] = $product['Preco'] * $newQuantity;
            break;
        }
    }
    $_SESSION['carrinho'] = $cart;

    // Retorne a nova quantidade e o novo total do produto em um objeto JSON
    $response = array(
        'quantidade' => $newQuantity,
        'total' => number_format($product['total'], 2, ',', '.')
    );
    echo json_encode($response);
} else {
    // Se o ID do produto e a nova quantidade não foram enviados, retorne um erro
    http_response_code(400);
    echo 'Erro: ID do produto e nova quantidade não foram enviados';
}
