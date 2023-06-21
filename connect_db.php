<?php
// Conecta ao banco de dados
$host = "localhost";
$usuario = "root";
$senha = "";
$dbname = "saboresbrasil";

$conn = new mysqli($host, $usuario, $senha, $dbname);

//checar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
