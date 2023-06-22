<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require('connect_db.php');

$IDusuario = $_SESSION['IDuser'];

$sql = "SELECT * FROM Usuarios WHERE IDuser = ?";
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
}

if (!isset($_SESSION['IDuser'])) {
    echo '<script>alert("Por favor, faça o login!"); window.location.href = "pages/login.php";</script>';
    exit();
} else {
    echo '<script>console.log("Você está logado como ' . $_SESSION["nome"] . '");</script>';
}

if (isset($_POST['Total'])) {
    $totalEncomenda = floatval($_POST['Total']);
} else {
    echo "Erro: Total não definido.";
    exit();
}

// Prepara a declaração SQL para inserir a encomenda no banco de dados.
$stmt = $conn->prepare("INSERT INTO Encomendas (Cliente, Morada, Total, DataEncomenda) VALUES (?, ?, ?, NOW())");

$stmt->bind_param("sss", $nome, $morada, $totalEncomenda);

// Executa a declaração SQL preparada.
if ($stmt->execute()) {
    echo '<script>alert("Encomenda feita com sucesso! Aguarde o contacto da nossa equipa."); window.location.href = "index.php";</script>';
    // Esvazia o carrinho
    unset($_SESSION['carrinho']);
} else {
    echo "Erro ao inserir a encomenda: " . $stmt->error;
}

// Fecha a conexão
$conn->close();
