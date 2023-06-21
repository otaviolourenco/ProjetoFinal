<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require('connect_db.php');

if (!isset($_SESSION['IDuser'])) {
    echo '<script>alert("Por favor, faça o login!"); window.location.href = "pages/login.php";</script>';
    exit();
} else {
    echo '<script>console.log("Você está logado como ' . $_SESSION["nome"] . '");</script>';
}

if (isset($_SESSION['IDuser'])) {
    $IDusuario = $_SESSION['IDuser'];
} else {
    echo "Erro: ID de usuário não definido.";
    exit();
}

if (isset($_SESSION['Morada'])) {
    $morada = $_SESSION['Morada'];
} else {
    echo "Erro: Morada não definida.";
    exit();
}

if (isset($_POST['Total'])) {
    $totalEncomenda = floatval($_POST['Total']);
} else {
    echo "Erro: Total não definido.";
    exit();
}



// Prepara a declaração SQL para inserir a encomenda no banco de dados.
$stmt = $conn->prepare("INSERT INTO Encomendas (IDuser, Morada, Total, DataEncomenda) VALUES (?, ?, ?, NOW())");

$stmt->bind_param("iss", $IDusuario, $morada, $totalEncomenda);

// Executa a declaração SQL preparada.
if ($stmt->execute()) {
    echo "A encomenda foi inserida com sucesso!";
} else {
    echo "Erro ao inserir a encomenda: " . $stmt->error;
}

// Fecha a conexão
$conn->close();
