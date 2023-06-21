<?php
session_start();

include('../connect_db.php');
include('../assets/functions.php');

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

    <script src="../JS/jquery.js"></script>
</head>

<body>
    <!--Sob menu-->
    <div class="container-fluid sob-menu fixed-top d-none d-sm-block">
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

    <!--Mobile sob menu-->
    <div class="navbar-area d-block d-sm-none fixed-top">
        <div class="container">
            <nav class="site-navbar">
                <!-- site logo -->
                <div class="logo"><img src="../images/diversos/logo-nome.png" alt="" height="50"></div>

                <!-- site menu/nav -->
                <ul>
                    <div class="my-5">
                        <input class="input-search rounded-start-3" type="search" name="" id="">
                        <button class="btn-yellow rounded-end-3">Pesquisar</button>
                    </div>
                    <?php
                    session_start();
                    if (isset($_SESSION['IDuser'])) {
                        echo '<li><a class="text-white"> Olá, ' . $_SESSION['Nome'] . '!</a></li>';
                    } else {
                        echo '<a href="../pages/login.php"><button class="btn btn-primary-new mt-5"><i class="fa-solid fa-user"></i> Entrar</button></a>';
                    }
                    ?>

                    <li><a href="../pages/admPage.php" class="" style="<?php echo $admContent; ?>"><i class="fa-solid fa-screwdriver-wrench"></i> Painel Adm.</a></li>

                    <?php
                    session_start();
                    if (isset($_SESSION['IDuser'])) {
                        echo '<li><a href="../assets/logout.php" class="" title="Sair"><i class="fa-solid fa-right-from-bracket"></i>Sair</a></li>';
                    }
                    ?>
                </ul>

                <!-- nav-toggler for mobile version only -->
                <button class="nav-toggler">
                    <span></span>
                </button>
            </nav>
        </div>
    </div>

    <!--Breadcrumb-->
    <div class="container-fluid mobile-bc" style="padding-top: 7.62rem;">
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
                        if (isset($_SESSION['IDuser'])) {
                            echo '<p class="d-none d-sm-block"> Olá, ' . $_SESSION['Nome'] . '!</p>';
                        } else {
                            echo '<a href="../login.php"><button class="btn btn-primary-new d-none d-sm-block"><i class="fa-solid fa-user"></i> Entrar</button></a>';
                        }

                        if (isset($_SESSION['IDuser'])) {
                            echo '<a href="../assets/logout.php" class="link px-4 d-none d-sm-block" title="Sair"><i class="fa-solid fa-right-from-bracket"></i>Sair</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="window-full">
        <!--Itens no carrinho-->
        <div class="container py-5">
            <div class="row">
                <div class="col-md">
                    <?php if (empty($produtosCarrinho)) : ?>
                        <div class="text-center">
                            <h2>O seu carrinho está vazio. Adicione alguns dos nossos incríveis produtos!</h2>
                            <a href="../index.php#top-vendas">Ver produtos</a>
                        </div>
                    <?php else : ?>
                        <?php
                        $total = 0;
                        $desconto = 0;
                        ?>

                        <?php foreach ($produtosCarrinho as $row) : ?>
                            <div class="d-flex flex-row justify-content-evenly my-2 py-4 rounded-3 table-responsive" style="background-color: var(--grey-color);">
                                <table id="tabela-carrinho">
                                    <tr class="tabela-cart">
                                        <th> </th>
                                        <th>Produto</th>
                                        <th>Valor</th>
                                        <th>Quant.</th>
                                        <th>Total</th>
                                    </tr>

                                    <tr>
                                        <td><img src="../images/<?php echo $row['FotoProduto']; ?>" alt="" height="90rem" width="90rem"></td>

                                        <td><?php echo $row['NomeProduto']; ?></td>

                                        <td>€<?php echo $row['PrecoPromo']; ?></td>

                                        <td><?php echo $row['quantidade']; ?></td>

                                        <td>€<?php echo $row['PrecoPromo'] * $row['quantidade']; ?></td>

                                    </tr>
                                </table>
                            </div>
                            <?php
                            $total += $row['PrecoPromo'] * $row['quantidade'];
                            $desconto += $row['Preco'] - $row['PrecoPromo'];
                            ?>
                        <?php endforeach; ?>

                    <?php endif; ?>
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
                        <h4><?php echo $total; ?>€</h4>
                    </span>
                    <hr>

                    <span class="tab-valor-total">
                        <h4>Entrega: </h4>
                        <h4><?php echo $entrega = 1.99; ?>€</h4>
                    </span>
                    <hr>

                    <span class="tab-valor-total">
                        <h2>Total: </h2>
                        <h2><?php echo $total + $entrega; ?>€</h2>
                    </span>
                    <hr>

                    <span class="tab-valor-total mb-5">
                        <h3>Você economizou nessa compra: </h3>
                        <h3><?php echo $desconto; ?>€</h3>
                    </span>


                    <a href="checkout.php" class="btn btn-primary-new w-100 mb-3">Checkout</a><br>
                    <a href="../index.php" class="btn btn-primary-new w-100">Continuar a comprar</a>
                </div>
            </div>
        </div>
    </div>

    <!--Scroll to top-->
    <button onclick="topFunction()" id="topBtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>

    <!--Sob footer-->
    <div class="container-fluid pt-5 text-white" style="background-color: var(--soft-black);">
        <div class="row d-flex justify-content-between">
            <div class="col-sm-4 p-5">
                <h2>Sabores do Brasil.</h2>
                <p>Nós nos dedicamos a trazer a autêntica experiência brasileira diretamente para a sua casa em Portugal, permitindo que você saboreie os irresistíveis sabores e/ou conheça a rica cultura do Brasil. Aproveite o nosso serviço de entrega e desfrute do melhor sem sair do conforto do seu lar.</p>
                <div class="redes-sociais"></div>
            </div>

            <div class="col-sm-4 p-5">
                <h3>Loja física</h3>
                <p>Morada: rua Dom Joao VI, n35, loja 4, Lisboa</p>
                <p>tel: 213 145 221</p>
                <p>Email: <a href="mailto:email@email.com" class="text-email">apoiocliente@saboresdobrasil.com</a></p>
            </div>
        </div>
    </div>

    <!--Footer-->
    <footer class="container-fluid d-flex justify-content-between align-items-center" style="background-color: var(--black-color); height: 15rem;">
        <div class="row px-5 w-100">

            <div class="col-sm-6 footer d-flex justify-content-center align-items-center">
                <p style="color: var(--white-color);">Desenvolvido por Otávio Lourenço</p>
            </div>

            <div class="col-sm-6 d-flex justify-content-center align-items-center">
                <div class="pgmto-metodos float-end">
                    <img src="../images/diversos/site-seguro.png" height="60rem" alt="">
                </div>
            </div>
        </div>
    </footer>

    <script src="../JS/comportamentos.js"></script>
</body>

</html>