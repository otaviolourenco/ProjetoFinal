<?php
session_start();

if ($_SESSION['NivelAcesso'] == 1) {
    $admContent = "display: block;";
} else {
    $admContent = "display: none;";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../connect_db.php');

    $id = $_POST['id'];
    $nomeProduto = $_POST['NomeProduto'];
    $preco = $_POST['Preco'];
    $precoPromo = $_POST['PrecoPromo'];
    $qtEstoque = $_POST['QtEstoque'];

    $sql = "UPDATE Produtos SET NomeProduto=?, Preco=?, PrecoPromo=?, QtEstoque=? WHERE IDproduto=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sddii', $nomeProduto, $preco, $precoPromo, $qtEstoque, $id);

    if ($stmt->execute()) {
        echo '<script>alert("Produto atualizado"); window.location.href = "../pages/admPage.php";</script>';
    } else {
        echo '<script>alert("Erro ao atualizar produto"); window.location.href = "../pages/admPage.php";</script>';
    }

    $stmt->close();
    $conn->close();
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

                <div class="logo"><img src="../images/diversos/logo-nome.png" alt="" height="50"></div>
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

                    <li><a href="../index.php">Início</a></li>
                    <li><a href="pages/cart.php" class=""><i class="fa-solid fa-cart-shopping"></i> Ver carrinho</a></li>

                    <li><a href="../pages/admPage.php" class="" style="<?php echo $admContent; ?>"><i class="fa-solid fa-screwdriver-wrench"></i> Painel Adm.</a></li>

                    <?php
                    session_start();
                    if (isset($_SESSION['IDuser'])) {
                        echo '<li><a href="../assets/logout.php" class="" title="Sair"><i class="fa-solid fa-right-from-bracket"></i>Sair</a></li>';
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
                        <li><a href="../index.php">Início</a></li>
                    </ul>
                    <div class="float-end me-5 d-flex flex-row justify-content-evenly">
                        <?php
                        session_start();
                        if (isset($_SESSION['IDuser'])) {
                            echo '<p> Olá, ' . $_SESSION['Nome'] . '!</p>';
                        } else {
                            echo '<a href="../pages/login.php"><button class="btn btn-primary-new"><i class="fa-solid fa-user"></i> Entrar</button></a>';
                        }
                        ?>
                        <a href="../pages/cart.php" class="link px-4"><i class="fa-solid fa-cart-shopping"></i> Ver carrinho</a>

                        <a href="../pages/admPage.php" class="link active px-4" style="<?php echo $admContent; ?>"><i class="fa-solid fa-screwdriver-wrench"></i> Painel Adm.</a>

                        <?php
                        session_start();
                        if (isset($_SESSION['IDuser'])) {
                            echo '<a href="../assets/logout.php" class="link px-4" title="Sair"><i class="fa-solid fa-right-from-bracket"></i>Sair</a>';
                        }
                        ?>
                    </div>
                </nav>

            </div>
        </div>
    </div>

    <!--Encomendas-->
    <div class="container">
        <div class="row mt-5 d-flex justify-content-around">
            <div class="col-md-5 d-flex flex-column rounded-3 mb-4 p-5" style="background-color: var(--grey-color)">
                <h2 class="mb-3 text-center">Encomendas</h2>

                <?php
                require('../connect_db.php');

                $sql = "SELECT * FROM Encomendas";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table lista-checkout'>";
                    echo "<tr>";
                    echo "<th>Cliente </th>";
                    echo "<th>Morada </th>";
                    echo "<th>Total </th>";
                    echo "<th>Data da Encomenda</th>";
                    echo "</tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Cliente"] . "</td>";
                        echo "<td>" . $row["Morada"] . "</td>";
                        echo "<td>" . $row["Total"] . "</td>";
                        echo "<td>" . $row["DataEncomenda"] . "</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "<p class='text-center'>Não há encomendas registradas.</p>";
                }
                $conn->close();
                ?>
            </div>

            <!--Administração dos produtos-->
            <div class="col-md-5 d-flex flex-column justify-content-center align-items-center rounded-3 mb-4 p-5" style="background-color: var(--grey-color)">
                <h2 class="m-3 text-center">Adicione aqui os produtos</h2>
                <form action="../images/inserir_produtos.php" method="POST" enctype="multipart/form-data" id="form-add-produto">
                    <input type="text" name="nomeProduto" placeholder="Nome do produto" required><br>

                    <input type="text" name="preco" placeholder="Preço" required><br>

                    <input type="text" name="precoPromo" placeholder="Preço Promocional"><br>

                    <input type="number" name="qtEstoque" id="" placeholder="Qtd. Estoque" required><br>

                    <label for="file-input" class="drop-container">
                        <span class="drop-title">Adicionar imagem</span>

                        <input type="file" name="foto_produto" accept="image/*" required="" id="file-input" required>
                    </label>

                    <input class="btn btn-primary-new w-100" type="submit" value="Enviar">

                </form>
            </div>
        </div>
    </div>

    <!--Gestão dos Produtos-->
    <div class="container">
        <div class="row">
            <div class="col-md">
                <h2 class="m-3">Gestão de produtos</h2>
                <div class="container-produtos ">
                    <?php
                    require('../connect_db.php');

                    $sql = "SELECT * FROM Produtos";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<form action="admPage.php" method="POST" class="form-Gest-Pdt">';
                            echo '<input type="hidden" name="id" value="' . $row['IDproduto'] . '">';
                            echo 'Nome do Produto: <input type="text" name="NomeProduto" value="' . $row['NomeProduto'] . '"><br>';
                            echo 'Preço: <input type="text" name="Preco" value="' . $row['Preco'] . '"><br>';
                            echo 'Preço Promocional: <input type="text" name="PrecoPromo" value="' . $row['PrecoPromo'] . '"><br>';
                            echo 'Qtd. Estoque: <input type="number" name="QtEstoque" value="' . $row['QtEstoque'] . '"><br>';
                            echo '<input class="btn btn-primary-new" type="submit" value="Atualizar">';
                            echo '</form>';
                        }
                    }

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>

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