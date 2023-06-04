<?php
session_start();
include('../connect_db.php');

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['senha']);

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
