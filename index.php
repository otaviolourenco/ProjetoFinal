<?php
session_start();

$_SESSION['nome'] = $nome;
$_SESSION['email'] = $email;

if ($_SESSION['NivelAcesso'] == 1) {
    $admContent = "display: block;";
} else {
    $admContent = "display: none;";
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

    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/c6aa19193c.js" crossorigin="anonymous"></script>

    <script src="JS/jquery.js"></script>
</head>

<body>
    <!--Sob menu-->
    <div class="container-fluid sob-menu fixed-top d-none d-sm-block">
        <div class="row">
            <div class="col-sm " style="background-color: var(--primary-color);">
                <div class="d-flex justify-content-around align-items-center">
                    <span class="logo"><img src="images/diversos/logo-nome.png" alt="" height="50"></span>

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

                <div class="logo"><img src="images/diversos/logo-nome.png" alt="" height="50"></div>
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
                        echo '<a href="pages/login.php"><button class="btn btn-primary-new mt-5"><i class="fa-solid fa-user"></i> Entrar</button></a>';
                    }
                    ?>

                    <li><a href="#">Início</a></li>
                    <li><a href="#categoria">Categorias</a></li>
                    <li><a href="#top-vendas">Recomendados</a></li>
                    <li><a href="pages/cart.php" class=""><i class="fa-solid fa-cart-shopping"></i> Ver carrinho</a></li>

                    <li><a href="pages/admPage.php" class="" style="<?php echo $admContent; ?>"><i class="fa-solid fa-screwdriver-wrench"></i> Painel Adm.</a></li>

                    <?php
                    session_start();
                    if (isset($_SESSION['IDuser'])) {
                        echo '<li><a href="assets/logout.php" class="" title="Sair"><i class="fa-solid fa-right-from-bracket"></i>Sair</a></li>';
                    }
                    ?>
                </ul>

                <button class="nav-toggler">
                    <span></span>
                </button>
            </nav>
        </div>
    </div>

    <div class="d-block d-sm-none" style="padding-top: 6rem;"></div>

    <!--Menu-->
    <div class="container-fluid d-none d-sm-block" style="padding-top: 7.5rem;">
        <div class="row">
            <div class="col-sm" style="background-color: var(--grey-color); height: 5rem;">
                <nav class="nav-bar d-flex flex-row justify-content-around align-items-center">
                    <ul>
                        <li><a href="#" class="link active">Início</a></li>
                        <li><a href="#categoria">Categorias</a></li>
                        <li><a href="#top-vendas">Recomendados</a></li>
                    </ul>
                    <div class="float-end me-5 d-flex flex-row justify-content-evenly">
                        <?php
                        session_start();
                        if (isset($_SESSION['IDuser'])) {
                            echo '<p> Olá, ' . $_SESSION['Nome'] . '!</p>';
                        } else {
                            echo '<a href="pages/login.php"><button class="btn btn-primary-new"><i class="fa-solid fa-user"></i> Entrar</button></a>';
                        }
                        ?>
                        <a href="pages/cart.php" class="link px-4"><i class="fa-solid fa-cart-shopping"></i> Ver carrinho</a>

                        <a href="pages/admPage.php" class="link px-4" style="<?php echo $admContent; ?>"><i class="fa-solid fa-screwdriver-wrench"></i> Painel Adm.</a>

                        <?php
                        session_start();
                        if (isset($_SESSION['IDuser'])) {
                            echo '<a href="assets/logout.php" class="link px-4" title="Sair"><i class="fa-solid fa-right-from-bracket"></i>Sair</a>';
                        }
                        ?>
                    </div>
                </nav>

            </div>
        </div>
    </div>

    <!--Mensagem add carrinho sucesso-->
    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="d-flex justify-content-center fixed-top">
                    <div id="msg-sucesso" style="display: none;" class="alert alert-success" role="alert">
                        <p>O produto foi adicionado! <a href="pages/cart.php">Clique para ver o carrinho.</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Carousel-->
    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/carousel/carousel-1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/carousel/carousel-2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/carousel/carousel-3.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!--Promos-->
    <div class="container">
        <div class="row py-5">
            <h2>Descontos da semana</h2>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-sm d-flex flex-row flex-wrap justify-content-evenly" style="z-index: -99;">
            <div class="card-container">
                <div class="card-promo">
                    <div class="front-content">
                        <img src="images/produtos/tapioca.jpeg" alt="" class="img-desc">
                        <img src="images/produtos/30off.png" alt="" class="tag-desc">
                    </div>
                    <div class="content">
                        <p class="heading">Tapioca</p>
                        <p>
                            Massa de tapioca pronta, Grafino com 30% de desconto.
                        </p>
                        <?php
                        include('connect_db.php');

                        $sql = "SELECT * FROM Produtos WHERE IDproduto = 14";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<input type='hidden' name='IDproduto' value=<" . $row['IDproduto'] . ">";
                            echo "<a href='adicionar_carrinho.php?idProduto=" . $row['IDproduto'] . "'class='btn-promo btn-add-car'>Comprar</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>


            <div class="card-container">
                <div class="card-promo">
                    <div class="front-content">
                        <img src="images/produtos/pao-queijo.jpeg" alt="" class="img-desc">
                        <img src="images/produtos/40off.png" alt="" class="tag-desc">
                    </div>
                    <div class="content">
                        <p class="heading">Pão de Queijo</p>
                        <p>
                            Pão de queijo pronto para ir ao forno, 300g DeMarchi com 40% de desconto.
                        </p>
                        <?php
                        include('connect_db.php');

                        $sql = "SELECT * FROM Produtos WHERE IDproduto = 13";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<input type='hidden' name='IDproduto' value=<" . $row['IDproduto'] . ">";
                            echo "<a href='adicionar_carrinho.php?idProduto=" . $row['IDproduto'] . "'class='btn-promo btn-add-car'>Comprar</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="card-container">
                <div class="card-promo">
                    <div class="front-content">
                        <img src="images/produtos/acai-gd.jpeg" alt="" height="150" class="img-desc">
                        <img src="images/produtos/30off.png" alt="" class="tag-desc">
                    </div>
                    <div class="content">
                        <p class="heading">Açaí 250ml</p>
                        <p>
                            Açaí Goola 250ml zero glútem, gordura trans e lactose. Saboroso e original do Brasil.
                        </p>
                        <?php
                        include('connect_db.php');

                        $sql = "SELECT * FROM Produtos WHERE IDproduto = 6";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<input type='hidden' name='IDproduto' value=<" . $row['IDproduto'] . ">";
                            echo "<a href='adicionar_carrinho.php?idProduto=" . $row['IDproduto'] . "'class='btn-promo btn-add-car'>Comprar</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="card-container">
                <div class="card-promo">
                    <div class="front-content">
                        <img src="images/produtos/pacoca.jpeg" alt="" height="170" class="img-desc">
                        <img src="images/produtos/30off.png" alt="" class="tag-desc">
                    </div>
                    <div class="content">
                        <p class="heading">Paçoca</p>
                        <p>
                            Paçoca/Doce de amendoim Moreninha do Rio, com 16 unidades. Compre agora com 30% de desconto.
                        </p>
                        <?php
                        include('connect_db.php');

                        $sql = "SELECT * FROM Produtos WHERE IDproduto = 12";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<input type='hidden' name='IDproduto' value=<" . $row['IDproduto'] . ">";
                            echo "<a href='adicionar_carrinho.php?idProduto=" . $row['IDproduto'] . "'class='btn-promo btn-add-car'>Comprar</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <!--Categoria-->
    <div class="container">
        <div class="row py-5">
            <h2>Categoria</h2>
        </div>
    </div>
    <div class="container-fluid container-cat" id="categoria">
        <div class="row">
            <div class="col-sm d-flex justify-content-evenly flex-wrap">
                <div class="card-top card-cat">
                    <img src="images/diversos/cat-bebidas.jpeg" class="card-img-top" alt="..." height="180">
                    <div class="card-img p-2">
                        <h2>Bebidas</h2>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">Seja para matar a sede em um dia quente ou para apreciar um bom drinque com amigos, temos a bebida perfeita para cada ocasião.</p>
                        <a href="#" class="btn btn-primary-new mb-3">Ver tudo</a>
                    </div>
                </div>

                <div class="card-top card-cat">
                    <img src="images/diversos/cat-doces.jpeg" class="card-img-top" alt="..." height="180">
                    <div class="card-img p-2">
                        <h2>Doces</h2>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">Perfeitos para presentear, compartilhar com amigos ou simplesmente saborear sozinho, nossos doces brasileiros vão conquistar seu coração e seu paladar.</p>
                        <a href="#" class="btn btn-primary-new mb-3">Ver tudo</a>
                    </div>
                </div>

                <div class="card-top card-cat">
                    <img src="images/diversos/cat-selfcare.jpeg" class="card-img-top" alt="..." height="180">
                    <div class="card-img p-2">
                        <h2>Cuidados pessoais</h2>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">Desde os hidratantes corporais até os shampoos e condicionadores, temos tudo o que você precisa para se sentir renovado e revigorado.</p>
                        <a href="#" class="btn btn-primary-new mb-3">Ver tudo</a>
                    </div>
                </div>

                <div class="card-top card-cat">
                    <img src="images/diversos/cat-comidas.jpeg" class="card-img-top" alt="..." height="180">
                    <div class="card-img p-2">
                        <h2>Produtos regionais</h2>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">Com uma variedade de produtos alimentares tradicionais de cada região do Brasil, oferecemos uma experiência única de sabores e aromas.</p>
                        <a href="#" class="btn btn-primary-new mb-3">Ver tudo</a>
                    </div>
                </div>

                <div class="card-top card-cat">
                    <img src="images/diversos/cat-utensilios.jpeg" class="card-img-top" alt="..." height="180">
                    <div class="card-img p-2">
                        <h2>Utensílios</h2>
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">Temos opções para todas as necessidades, desde os utensílios mais básicos como cuscuzeiras até os mais sofisticados, como bombas de chimarrão.</p>
                        <a href="#" class="btn btn-primary-new mb-3">Ver tudo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Itens-->
    <div class="container py-5">
        <div class="row py-5">
            <h2>Itens</h2>
        </div>

        <div class="row">
            <div class="col-sm d-flex justify-content-evenly flex-wrap">
                <?php
                include('connect_db.php');

                $sql = "SELECT * FROM Produtos ORDER BY RAND() LIMIT 5";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {

                    if (!empty($row['FotoProduto'])) {
                        $imgCaminho = $row['FotoProduto'];
                    }
                    echo '<div class="card-top"> 
                    <img src="images/' . $imgCaminho . '"class="card-img-top" alt="..." height="180">
                    <div class="pt-3 px-3">
                        <ol class="rated-star">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-regular fa-star-half-stroke"></i></li>
                        </ol>';
                    echo "<p class=''>" . $row['NomeProduto'] . "</p>";
                    echo "<div class='d-flex flex-row justify-content-around align-items-center pb-2'>";

                    if ($row['QtEstoque'] == 0) {
                        echo "<p class='text-danger'>Produto sem estoque</p>";
                    } else {
                        echo "<p class='fs-2'>" . $row['PrecoPromo'] . " €</p>";
                        echo "<p class='text-danger text-decoration-line-through px-3'>" . $row['Preco'] . " €</p>";
                        echo "<form action='index.php' method='post'>";
                        echo "<input type='hidden' name='IDproduto' value='" . $row['IDproduto'] . "'>";
                        echo "<a href='adicionar_carrinho.php?idProduto=" . $row['IDproduto'] . "' class='btn-add-car float-end'><i class='fa-solid fa-cart-plus'></i></a>";
                        echo "</form>";
                    }

                    echo "</div>
                    </div>
                </div>";
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>

    <!--CTA ofertas-->
    <div class="container py-5">
        <div class="row py-5">
            <h2>Ofertas</h2>
        </div>

        <div class="row d-flex flex-wrap">
            <div class="col-md-6 mb-3">
                <div class="card sombra-efeito" id="CTA-1">
                    <div class="p-5">
                        <h2 class="text-danger"><span style="color: var(--red-color); font-size: 3.5rem;">25%</span> de desconto!</h2>
                        <h3 class="py-3">Nas compras acima de 100€ você <br> ganha esse incrível desconto. Aproveite agora!</h3>
                        <h5>Promoção válida por tempo limitado</h5>
                        <a href="#" class="btn btn-primary-new my-3">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card sombra-efeito" id="CTA-2">
                    <div class="p-5">
                        <h2>Todos os produtos para a sua feijoada, <br> com desconto de</h2>
                        <img src="images/diversos/15desc.png" alt="" height="70">
                        <h5>Promoção válida por tempo limitado</h5>
                        <a href="#" class="btn btn-primary-new my-2">Comprar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Mais vendidos-->
    <div class="container py-5" id="top-vendas">
        <div class="row">
            <h2>Mais vendidos</h2>
        </div>
        <div class="row d-flex flex-wrap">
            <div class="col-md-8 d-flex justify-content-center flex-wrap">
                <?php
                include('connect_db.php');

                $sql = "SELECT * FROM Produtos ORDER BY RAND() LIMIT 6";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {

                    if (!empty($row['FotoProduto'])) {
                        $imgCaminho = $row['FotoProduto'];
                    }
                    echo '<div class="card-top"> 
                    <img src="images/' . $imgCaminho . '"class="card-img-top" alt="..." height="180">
                    <div class="pt-3 px-3">
                        <ol class="rated-star">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-regular fa-star-half-stroke"></i></li>
                        </ol>';
                    echo "<p class=''>" . $row['NomeProduto'] . "</p>";
                    echo "<div class='d-flex flex-row justify-content-around align-items-center pb-2'>";

                    if ($row['QtEstoque'] == 0) {
                        echo "<p class='text-danger'>Produto sem estoque</p>";
                    } else {
                        echo "<p class='fs-2'>" . $row['PrecoPromo'] . " €</p>";
                        echo "<p class='text-danger text-decoration-line-through px-3'>" . $row['Preco'] . " €</p>";
                        echo "<form action='index.php' method='post'>";
                        echo "<input type='hidden' name='IDproduto' value='" . $row['IDproduto'] . "'>";
                        echo "<a href='adicionar_carrinho.php?idProduto=" . $row['IDproduto'] . "' class='btn-add-car float-end'><i class='fa-solid fa-cart-plus'></i></a>";
                        echo "</form>";
                    }

                    echo "</div>
                    </div>
                </div>";
                }
                mysqli_close($conn);
                ?>
            </div>

            <div class="col-md-4">
                <?php
                include('connect_db.php');

                $sql = "SELECT * FROM Produtos WHERE IDproduto = 14";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {

                    if (!empty($row['FotoProduto'])) {
                        $imgCaminho = $row['FotoProduto'];
                    }
                    echo '<div class="card card-oferta text-center">
                        <h3>Essa oferta acaba em:</h3>
                        <div id="countdown" class="">
                        <ul>
                            <li class="count-border" id="dias"></li>
                            <li class="count-border" id="horas"></li>
                            <li class="count-border" id="minutos"></li>
                            <li class="count-border" id="segundos"></li>
                        </ul> 
                        <img src="images/' . $imgCaminho . '"alt="..." width="100%">
                    <div>
                        <ol class="rated-star d-flex justify-content-center p-3" style="font-size: 2.6rem;">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-regular fa-star-half-stroke"></i></li>
                        </ol>';
                    echo "<p class=''>" . $row['NomeProduto'] . "</p>";
                    echo "<div class=''>
                            <p class='text-danger text-decoration-line-through m-0' style='font-size: 2rem;'>" . $row['Preco'] . " €</p>";
                    echo "<p style='font-size: 4rem;'>" . $row['PrecoPromo'] . " €</p>";
                    echo "<input type='hidden' name='IDproduto' value=<" . $row['IDproduto'] . ">";
                    echo "<a href='adicionar_carrinho.php?idProduto=" . $row['IDproduto'] . "' class='btn btn-add-car btn-primary-new mb-4 w-100'>Adicionar ao carrinho</a>
                        </div>
                    </div>
                </div>";
                }
                ?>
            </div>
        </div>
    </div>
    </div>

    <!--CTA-->
    <div class="container py-5">
        <div class="row text-center d-flex justify-content-center">
            <div class="col-sm-8 p-5 text-white" style="background-image: url('images/diversos/banner-desconto.png'); background-size: cover; background-repeat: no-repeat;">
                <h2>Ganhe 30% de desconto!</h2>
                <p>Nas compras acima de 100€, você tem o desconto direto no caixa </p>
                <h6>Promoção válida apenas para compras na loja física.</h6>
            </div>
        </div>
    </div>

    <!--Entrega e Pgmto-->
    <div class="container py-5">
        <div class="row p-5 d-flex justify-content-between flex-wrap">
            <div class="col-md-7 m-2 d-flex flex-row flex-wrap align-items-center card sombra-efeito">
                <div style="width: 30rem;">
                    <img src="images/diversos/entrega.png" width="100%" alt="">
                </div>
                <div class="d-flex flex-column">
                    <h2 class="my-4">Entrega segura</h2>
                    <p><i class="fa-solid fa-circle-check"></i> Entregas agendadas</p>
                    <p><i class="fa-solid fa-circle-check"></i> Pagamento sem contato</p>
                    <p><i class="fa-solid fa-circle-check"></i> Embalagem protegida</p>
                    <button class="btn btn-primary-new w-50 p-2 my-4">Pedir</button>
                </div>
            </div>

            <div class="col-md-4 m-2 p-5 form-pgmto d-flex justify-content-center align-items-center card sombra-efeito">
                <div class="row">
                    <div class="text-center">
                        <h2>Mais segurança e praticidade para você!</h2>
                        <p>Aceitamos os principais meios de pagamentos</p>
                        <img src="images/diversos/bandeiras.png" alt="Pagamentos aceites">
                    </div>
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
                    <img src="images/diversos/site-seguro.png" height="60rem" alt="">
                </div>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script src="JS/countdown.js"></script>
    <script src="JS/comportamentos.js"></script>
</body>

</html>