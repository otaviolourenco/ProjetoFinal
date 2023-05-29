<?php
//verifica se o usuário está logado
session_start();

if (!isset($_SESSION['IDcliente'])) {
    echo '<script>alert("Por favor, faça o login!"); window.location.href = "../content/login.php";</script>';
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
                        <a href="assets/logout.php" class="px-4 pt-2" title="Sair"><i class="fa-solid fa-right-from-bracket"></i></a>
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
                    <h2>Resumo da compra</h2>

                    <a href="" class="btn btn-primary-new">Efetuar pagamento</a>
                </div>
            </div>
        </div>
    </div>

    <script src="../JS/comportamentos.js"></script>
</body>

</html>