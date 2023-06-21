<?php
session_start();

if (!isset($_SESSION['IDuser'])) {
    echo '<script>alert("Por favor, faça o login!"); window.location.href = "pages/login.php";</script>';
    exit();
} else {
    echo '<script>console.log("Você está logado como ' . $_SESSION["nome"] . '");</script>';
}
