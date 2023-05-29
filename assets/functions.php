<?php

function enviarFoto()
{
    include('connect_db.php');

    if (isset($_FILES['foto-perfil'])) {

        $arquivo = $_FILES['foto-perfil'];

        if ($arquivo['error'] > 0) {
            echo '<script>alert("Erro ao enviar arquivo."); </script>';
        }

        if ($arquivo['size'] > 4194304) {
            echo '<script>alert("O arquivo muito grande."); </script>';
        }

        $caminho = __DIR__ . '/uploads/';
        $arquivoNome = $arquivo['name'];
        $extensao = strtolower(pathinfo($arquivoNome, PATHINFO_EXTENSION));

        if ($extensao == 'jpg' || $extensao == 'png') {

            $novoNome = uniqid();
            $path = $caminho . $novoNome . '.' . $extensao;
            move_uploaded_file($arquivo['tmp_name'], $path);
            $pathRel = str_replace(__DIR__, '', $path);

            $conn->query("UPDATE usuarios SET foto = '$pathRel' WHERE user_id = {$_SESSION['user_id']}") or die($conn->error);
            echo '<script>alert("Arquivo enviado com sucesso!"); window.location.href = "../portal.php"; </script>';
        } else {
            echo '<script>alert("Arquivo inválido."); </script>';
        }
    }
}
