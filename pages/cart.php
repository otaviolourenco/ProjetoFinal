<?php
session_start();

include('../connect_db.php');

function obterProduto($conn, $idProduto)
{
    $query = "SELECT * FROM Produtos WHERE IDproduto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $idProduto);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}


if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $idProduto => $quantidade) {
        $produto = obterProduto($conn, $idProduto);
        $produto['quantidade'] = $quantidade;
        $produtosCarrinho[] = $produto;
    }
}
?>

<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Aqui você irá encontrar os melhores produtos diretamente do Brasil, em Portugal. Produtos com qualidade, sabor e o melhor preço.">

    <meta name="author" content="Otávio Lourenço">

    <title>Sabores do Brasil - Mercearia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">

    <script src="https://kit.fontawesome.com/c6aa19193c.js" crossorigin="anonymous"></script>
</head>

<body>
    <!--Sob menu-->
    <div class="container-fluid sob-menu fixed-top">
        <div class="row">
            <div class="col-sm " style="background-color: var(--primary-color);">
                <div class="d-flex justify-content-around align-items-center">
                    <span class="logo"><img src="../images/diversos/logo-nome.png" alt="" height="50"></span>

                    <div>
                        <input class="input-search rounded-start-3" type="search" name="" id="">
                        <button class="btn-yellow rounded-end-3">Pesquisar</button>
                    </div>

                    <span class="tel"><i class="fa-solid fa-headset"></i> 213 145 221
                        <h4>suporte 24h/7dias</h4>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!--Breadcrumb-->
    <div class="container-fluid" style="padding-top: 7.62rem;">
        <div class="row">
            <div class="col-sm d-flex justify-content-around align-items-center" style="background-color: var(--grey-color); height: 5rem;">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Carrinho</li>
                    </ul>
                </nav>

                <div>
                    <div class="float-end me-5 d-flex flex-row justify-content-evenly">
                        <?php
                        session_start();
                        if (isset($_SESSION['IDcliente'])) {
                            echo '<p> Olá, ' . $_SESSION['Nome'] . '!</p>';
                        } else {
                            echo '<a href="login.php"><button class="btn btn-primary-new"><i class="fa-solid fa-user"></i> Entrar</button></a>';
                        }
                        ?>
                        <a href="../assets/logout.php" class="px-4" title="Sair"><i class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Itens no carrinho-->
    <div class="container py-5">
        <div class="row">
            <div class="col-md">
                <?php foreach ($produtosCarrinho as $row) : ?>
                    <div class="d-flex flex-row justify-content-evenly my-2 py-4 rounded-3 table-responsive" style="background-color: var(--grey-color);">
                        <table>
                            <tr class="tabela-cart">
                                <th> </th>
                                <th>Produto</th>
                                <th>Valor</th>
                                <th>Quant.</th>
                                <th>Total</th>
                            </tr>

                            <tr>
                                <td><img src="../images/carousel/carousel.jpg" alt="" height="90rem" width="90rem"></td>

                                <td><?php echo $row['NomeProduto']; ?></td>

                                <td>€<?php echo $row['Preco']; ?></td>

                                <td>
                                    <form action="cart.php" method="POST">
                                        <input class="input-quant" type="number" name="quantidade" id="" value="<?php echo $row['quantidade']; ?>">
                                    </form>
                                </td>

                                <td>€<?php echo $row['Preco'] * $row['quantidade']; ?></td>

                                <td><button class="btn btn-primary-new">Remover</button></td>
                            </tr>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!--valor total-->
    <div class="container py-5">
        <div class="row">
            <h2>Total das compras</h2>
            <div class="col-sm rounded-3 p-4" style="background-color: var(--grey-color);">
                <span class="tab-valor-total">
                    <h4>Subtotal: </h4>
                    <h4>€5,89</h4>
                </span>
                <hr>

                <span class="tab-valor-total">
                    <h4>Desconto: </h4>
                    <h4>€0,00</h4>
                </span>
                <hr>

                <span class="tab-valor-total">
                    <h4>Entrega: </h4>
                    <h4>€0,00</h4>
                </span>
                <hr>

                <span class="tab-valor-total mb-5">
                    <h2>Total: </h2>
                    <h2>€0,00</h2>
                </span>

                <a href="checkout.php" class="btn btn-primary-new w-100 mb-3">Checkout</a><br>
                <a href="../index.php" class="btn btn-primary-new w-100">Continuar a comprar</a>
            </div>
        </div>
    </div>

</body>

</html>