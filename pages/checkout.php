<?php
//verifica se o usuário está logado
session_start();

if (!isset($_SESSION['IDcliente'])) {
    echo '<script>alert("Por favor, faça o login!"); window.location.href = "login.php";</script>';
    exit();
} else {
    echo '<script>console.log("Você está logado como ' . $_SESSION["Nome"] . '");</script>';
}

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
                        <li class="breadcrumb-item"><a href="../pages/cart.php">Carrinho</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ul>
                </nav>

                <div>
                    <div class="float-end me-5 d-flex flex-row justify-content-evenly">
                        <?php
                        session_start();
                        if (isset($_SESSION['IDcliente'])) {
                            echo '<p> Olá, ' . $_SESSION['Nome'] . '!</p>';
                        } else {
                            echo '<a href="pages/login.php"><button class="btn btn-primary-new"><i class="fa-solid fa-user"></i> Entrar</button></a>';
                        }
                        ?>
                        <a href="../assets/logout.php" class="px-4 pt-2" title="Sair"><i class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Infor entrega-->
    <div class="container py-5">
        <div class="row">
            <h2>Entrega</h2>
        </div>

        <div class="row d-flex justify-content-between">
            <div class="col-md-8">
                <div class="card p-4 d-flex justify-content-center">
                    <form action="" method="post">
                        <div class="input-group mb-4">
                            <input required="" type="text" name="text" autocomplete="off" class="input-ck">
                            <label class="user-label">Primeiro nome</label>
                        </div>

                        <div class="input-group mb-4">
                            <input required="" type="text" name="text" autocomplete="off" class="input-ck">
                            <label class="user-label">Último nome</label>
                        </div>

                        <div class="input-group mb-4">
                            <input required="" type="text" name="text" autocomplete="off" class="input-ck">
                            <label class="user-label">Morada</label>
                        </div>

                        <div class="input-group mb-4">
                            <input required="" id="codigoPostalInput" type="text" name="text" autocomplete="off" maxlength="8" class="input-ck" oninput="formatarCodigoPostal(this)">
                            <label class="user-label">Código postal</label>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card p-4">
                    <h2 class="py-3">Resumo da compra</h2>
                    <?php if (empty($produtosCarrinho)) : ?>
                        <div class="text-center">
                            <h2>O seu carrinho está vazio. Adicione alguns dos nossos incríveis produtos!</h2>
                            <a href="../index.php#top-vendas">Ver produtos</a>
                        </div>
                    <?php else : ?>
                        <?php $total2 = 0; ?>
                        <table class="table lista-checkout">
                            <thead>
                                <tr>
                                    <th scope="col">Produto</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Qtd</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>

                            <?php foreach ($produtosCarrinho as $row) : ?>
                                <tbody>
                                    <tr>
                                        <td class="py-3"><?php echo $row['NomeProduto']; ?></td>
                                        <td class="py-3"><?php echo $row['PrecoPromo']; ?></td>
                                        <td class="py-3"><?php echo $row['quantidade']; ?></td>
                                        <td class="py-3"><?php echo $row['PrecoPromo'] * $row['quantidade']; ?></td>
                                    </tr>
                                </tbody>
                                <?php $total2 += $row['PrecoPromo'] * $row['quantidade']; ?>
                            <?php endforeach; ?>
                        </table>
                        <div class="d-flex justify-content-between px-3">
                            <h4>Entrega:</h4>
                            <h4><?php echo $entrega = 1.99; ?>€</h4>
                        </div>
                        <div class="d-flex justify-content-between p-3">
                            <h2>Total:</h2>
                            <h2><?php echo $total2 + $entrega; ?>€</h2>
                        </div>
                        <a href="" class="btn btn-primary-new">Efetuar pagamento</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../JS/comportamentos.js"></script>
</body>

</html>