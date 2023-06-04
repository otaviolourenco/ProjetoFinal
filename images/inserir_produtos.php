<?php

session_start();

// Conectando ao banco de dados
include('../connect_db.php');

// Verificando se o arquivo de imagem foi enviado
if (isset($_FILES['foto_produto']) && $_FILES['foto_produto']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto_produto"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificando se o arquivo é uma imagem
    $check = getimagesize($_FILES["foto_produto"]["tmp_name"]);
    if ($check !== false) {
        // Movendo o arquivo para a pasta de destino
        if (move_uploaded_file($_FILES["foto_produto"]["tmp_name"], $target_file)) {
            // Inserindo os dados do formulário na tabela "Produtos"
            $nome_produto = $_POST['nomeProduto'];
            $preco = $_POST['preco'];
            $preco_promo = $_POST['precoPromo'];
            $qt_estoque = $_POST['qtEstoque'];
            $foto_produto = $target_file;

            $sql = "INSERT INTO Produtos (NomeProduto, Preco, PrecoPromo, QtEstoque, FotoProduto) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssis", $nome_produto, $preco, $preco_promo, $qt_estoque, $foto_produto);

            if ($stmt->execute()) {
                echo '<script>alert("Produto adicionado com sucesso!"); window.location.href = "../pages/admPage.php" </script>';
            } else {
                echo "Erro: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } else {
        echo "O arquivo não é uma imagem.";
    }
} else {
    echo "Nenhuma imagem foi enviada.";
}

$conn->close();
