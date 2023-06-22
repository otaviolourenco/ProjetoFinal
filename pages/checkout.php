<?php
session_start();
include('../assets/functions.php');

$IDusuario = $_SESSION['IDuser'];

$sql = "SELECT Nome, dataNasc, Tel, Morada, CP FROM Usuarios WHERE IDuser = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $IDusuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome = $row['Nome'];
    $dataNasc = $row['dataNasc'];
    $tel = $row['Tel'];
    $morada = $row['Morada'];
    $Postal = $row['CP'];
} else {
    $nome = '';
    $dataNasc = '';
    $tel = '';
    $morada = '';
    $Postal = '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Nome'], $_POST['dataNasci'], $_POST['Contacto'], $_POST['Morada'], $_POST['CodPostal'])) {
        $nome = $_POST['Nome'];
        $dataNasc = $_POST['dataNasci'];
        $tel = $_POST['Contacto'];
        $morada = $_POST['Morada'];
        $Postal = $_POST['CodPostal'];

        $sql = "UPDATE Usuarios SET Nome = ?, dataNasc = ?, Tel = ?, Morada = ?, CP = ? WHERE IDuser = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $nome, $dataNasc, $tel, $morada, $Postal, $IDusuario);

        if ($stmt->execute()) {
            echo '<script>window.alert("Os dados foram salvos.")</script>';
        } else {
            echo "Erro: " . $stmt->error;
        }
    }
}

if (!isset($_SESSION['IDuser'])) {
    echo '<script>alert("Por favor, faça o login!"); window.location.href = "login.php";</script>';
    exit();
} else {
    echo '<script>console.log("Você está logado como ' . $_SESSION["Nome"] . '");</script>';
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
                        echo '<a href="pages/login.php"><button class="btn btn-primary-new mt-5"><i class="fa-solid fa-user"></i> Entrar</button></a>';
                    }
                    ?>

                    <li><a href="pages/admPage.php" class="" style="<?php echo $admContent; ?>"><i class="fa-solid fa-screwdriver-wrench"></i> Painel Adm.</a></li>

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
                        <li class="breadcrumb-item"><a href="../pages/cart.php">Carrinho</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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

    <!--Infor entrega-->
    <div class="window-full">
        <div class="container py-5">
            <div class="row d-flex justify-content-between">
                <div class="col-md-8">
                    <div class="card p-4 d-flex justify-content-center">
                        <h2>Entrega</h2>
                        <div class="p-5 d-flex justify-content-center">
                            <form action="" method="post" class="formEntrega">
                                <label for="nome">Nome completo</label>
                                <input type="text" name="Nome" id="nome" placeholder="Nome completo" value="<?php echo $nome; ?>">

                                <label for="dataNasci">Data de nascimento</label>
                                <input type="date" name="dataNasci" id="dataNasci" value="<?php echo $dataNasc; ?>">

                                <label for="tel">Telefone</label>
                                <input type="number" name="Contacto" id="tel" placeholder="912 345 678" value="<?php echo $tel; ?>">

                                <label for="morada">Morada</label>
                                <input type="text" name="Morada" placeholder="Morada" value="<?php echo $morada; ?>">

                                <label for="cp">Código Postal</label>
                                <input type="text" name="CodPostal" placeholder="Código Postal" value="<?php echo $Postal; ?>" onkeyup="formatarCodigoPostal(this)">

                                <input type="submit" value="Salvar" class="btn btn-primary-new">
                            </form>
                        </div>
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
                                <tbody>
                                    <?php foreach ($produtosCarrinho as $row) : ?>
                                        <?php
                                        $nomeProduto = htmlspecialchars($row['NomeProduto']);
                                        $precoPromo = $row['PrecoPromo'];
                                        $quantidade = intval($row['quantidade']);
                                        $totalLinha = $precoPromo * $quantidade;
                                        $total2 += $precoPromo * $quantidade;
                                        ?>
                                        <tr>
                                            <td class="py-3"><?php echo $nomeProduto; ?></td>
                                            <td class="py-3"><?php echo $precoPromo; ?>€</td>
                                            <td class="py-3"><?php echo $quantidade; ?></td>
                                            <td class="py-3"><?php echo $totalLinha; ?>€</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-between px-3">
                                <h4>Entrega:</h4>
                                <h4><?php echo $entrega = 1.99; ?>€</h4>
                            </div>
                            <div class="d-flex justify-content-between p-3">
                                <h2>Total:</h2>
                                <h2><?php echo number_format($total2 + $entrega, 2); ?>€</h2>
                            </div>
                            <form action="../encomendar.php" method="post">
                                <input type="hidden" name="Total" value="<?php echo $total2 + $entrega; ?>">
                                <button type="submit" class="btn btn-primary-new w-100">Efetuar encomenda</button>
                            </form>
                        <?php endif; ?>
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
                    <img src="../images/diversos/site-seguro.png" height="60rem" alt="">
                </div>
            </div>
        </div>
    </footer>

    <script src="../JS/comportamentos.js"></script>
</body>

</html>