<?php
include('../connect_db.php');

session_start();
if (!isset($_SESSION['IDuser'])) {
    header('location:../pages/login.php');
    exit();
}

function obterProduto($conn, $idProduto)
{
    $query = "SELECT * FROM Produtos WHERE IDproduto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $idProduto);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Carregar carrinho da sessão ou do cookie se disponível
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $carrinho = $_SESSION['carrinho'];
} else {
    $carrinho = array();
}

// Popular produtos do carrinho e salvar de volta na sessão
if (!empty($carrinho)) {
    foreach ($carrinho as $idProduto => $quantidade) {
        $produto = obterProduto($conn, $idProduto);
        $produto['quantidade'] = $quantidade;
        $produtosCarrinho[] = $produto;
    }
}

function checkStock($conn)
{
    $sql = "SELECT QtEstoque FROM Produtos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['QtEstoque'] == 0) {
                echo "<p>Fora de estoque</p>";
            }
        }
    } else {
        echo "Não há produtos cadastrados.";
    }
}


/*function checkIdade($conn)
{
    $sql = "SELECT dataNasc FROM Usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nascimento = new DateTime($row['dataNasc']);
            $hoje   = new DateTime('hoje');
            $idade = $nascimento->diff($hoje)->y;

            if ($idade < 18) {
                echo "<script type='text/javascript'>alert('Erro: Usuário tem menos de 18 anos.');</script>";
            } else {
                echo "<script type='text/javascript'>alert('encomenda realizada com sucesso');</script>";
            }
        }
    } else {
        echo "0 resultados";
    }
}

checkIdade($conn);
$conn->close();
*/