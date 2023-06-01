<?php
//verifica se o usuário está logado
session_start();

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

    <!--Administrativo dos produtos-->
    <div class="container d-flex justify-content-center align-items-center">
        <div class="row mt-5">
            <div class="col-md d-flex justify-content-center align-items-center p-5" style="background-color: var(--grey-color)">
                <form action="">
                    <input type="text" placeholder="Nome do produto"><br>

                    <input type="text" placeholder="Preço"><br>

                    <input type="text" placeholder="Preço Promocional"><br>

                    <input type="number" name="" id="" placeholder="Qtd. Estoque"><br>

                    <input type="file" name="" id=""><br>

                    <input type="submit" value="Enviar">

                </form>
            </div>
        </div>
    </div>

</body>

</html>