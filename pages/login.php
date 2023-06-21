<?php
session_start();

include('../connect_db.php');

if (isset($_POST['nome-reg']) && isset($_POST['email-reg']) && isset($_POST['senha-reg'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome-reg']);
    $email = mysqli_real_escape_string($conn, $_POST['email-reg']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha-reg']);

    // Verifica se o e-mail já está registrado
    $query = "SELECT * FROM Usuarios WHERE Email = '$email'";
    $resultado = $conn->query($query);
    if (mysqli_num_rows($resultado) == 0) {

        // Criptografa a senha
        $senha = password_hash($senha, PASSWORD_DEFAULT);

        // Insere o novo usuário no banco de dados
        $query = "INSERT INTO Usuarios (Nome, Email, Senha) VALUES ('$nome', '$email', '$senha')";
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

    $query = "SELECT * FROM Usuarios WHERE Email = '$email'";
    $resultado = $conn->query($query);

    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);
        if (password_verify($senha, $usuario['Senha'])) {
            session_start();
            $_SESSION['IDuser'] = $usuario['IDuser'];
            $_SESSION['Nome'] = $usuario['Nome'];
            $_SESSION['Email'] = $email;
            $_SESSION['Morada'] = $morada;
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

                    <input class="input email-valid" type="email" name="email-login" placeholder="Email" required="">

                    <input class="input senha-valid" type="password" name="senha-login" placeholder="Senha" required="">

                    <button>Entrar</button>
                </form>
            </div>

            <div class="register">
                <form class="form" action="login.php" method="POST">
                    <label class="label" for="chk" aria-hidden="true">Registar</label>

                    <input class="input" type="text" name="nome-reg" placeholder="Primeiro e último nome" required="">

                    <input class="input email-valid" type="email" name="email-reg" placeholder="Email" required="">

                    <input class="input senha-valid" type="password" name="senha-reg" placeholder="Senha" required="">

                    <button>Register</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>