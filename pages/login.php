<?php
session_start();

include('../connect_db.php');

if (isset($_POST['nome-reg']) && isset($_POST['email-reg']) && isset($_POST['senha-reg'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome-reg']);
    $email = mysqli_real_escape_string($conn, $_POST['email-reg']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha-reg']);

    // Verifica se o e-mail já está registrado
    $query = "SELECT * FROM Clientes WHERE Email = '$email'";
    $resultado = $conn->query($query);
    if (mysqli_num_rows($resultado) == 0) {

        // Criptografa a senha
        $senha = password_hash($senha, PASSWORD_DEFAULT);

        // Insere o novo usuário no banco de dados
        $query = "INSERT INTO Clientes (Nome, Email, Senha) VALUES ('$nome', '$email', '$senha')";
        if ($conn->query($query)) {
            // Redireciona para a página de login
            echo '<script>alert("Você se registou, faça login!"); window.location.href = "login.php"; </script>';
            exit();
        } else {
            echo "Erro ao registrar usuário: " . $conn->error;
        }
    } else {
        echo "O e-mail já está registrado. Por favor, utilize outro e-mail.";
    }
}


if (isset($_POST['email-login']) && isset($_POST['senha-login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email-login']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha-login']);

    $query = "SELECT * FROM Clientes WHERE Email = '$email'";
    $resultado = $conn->query($query);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        if (password_verify($senha, $usuario['Senha'])) {
            session_start();
            $_SESSION['IDcliente'] = $usuario['IDcliente'];
            $_SESSION['Nome'] = $usuario['Nome'];
            $_SESSION['Email'] = $email;
            $_SESSION['NivelAcesso'] = $usuario['NivelAcesso'];
            header('Location: ../index.php');
            exit();
        } else {
            $error = "Email ou senha incorretos.";
        }
    } else {
        $error = "Usuário não localizado. Registre-se!";
    }
}

if (isset($error)) {
    echo '<script>alert("' . $error . '"); window.location.href = "login.php"; </script>';
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Aqui você irá encontrar os melhores produtos diretamente do Brasil, em Portugal. Produtos com qualidade, sabor e o melhor preço.">

    <meta name="author" content="Otávio Lourenço">

    <title>Sabores do Brasil - Mercearia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style-login.css">

    <script src="https://kit.fontawesome.com/c6aa19193c.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="d-flex justify-content-center d-flex align-items-center" style="height: 100vh;">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="login">
                <form class="form" action="login.php" method="POST">
                    <label class="label" for="chk" aria-hidden="true">Entrar</label>
                    <input class="input" type="email" name="email-login" placeholder="Email" required="">
                    <input class="input" type="password" name="senha-login" placeholder="Senha" required="">
                    <button>Entrar</button>
                </form>
            </div>

            <div class="register">
                <form class="form" action="login.php" method="POST">
                    <label class="label" for="chk" aria-hidden="true">Registar</label>
                    <input class="input" type="text" name="nome-reg" placeholder="Nome completo" required="">
                    <input class="input" type="email" name="email-reg" placeholder="Email" required="">
                    <input class="input" type="password" name="senha-reg" placeholder="Senha" required="">
                    <button>Register</button>
                </form>
            </div>
        </div>



        <!--<form class="form_main" action="">
            <p class="heading">Login</p>
            <div class="inputContainer">
                <svg viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="inputIcon">
                    <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
                </svg>
                <input placeholder="E-mail" id="email" name="email" class="inputField" type="text">
            </div>

            <div class="inputContainer">
                <svg viewBox="0 0 16 16" fill="#2e2e2e" height="16" width="16" xmlns="http://www.w3.org/2000/svg" class="inputIcon">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
                </svg>
                <input placeholder="Senha" id="senha" name="senha" class="inputField" type="password">
            </div>


            <button id="button">Submit</button>
            <div class="signupContainer">
                <p>Don't have any account?</p>
                <a href="#">Sign up</a>
            </div>
        </form>-->

    </div>
</body>

</html>