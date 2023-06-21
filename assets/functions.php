<?php
include('../connect_db.php');

session_start();
if (!isset($_SESSION['IDuser'])) {
    header('location:../pages/login.php');
    exit();
}

$produtosCarrinho = array();

function obterProduto($conn, $idProduto)
{
    $query = "SELECT * FROM Produtos WHERE IDproduto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $idProduto);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Carregar carrinho da sessão ou do cookie se disponível
if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])) {
    $carrinho = $_SESSION['carrinho'];
} elseif (isset($_COOKIE['carrinho'])) {
    $carrinho = $_COOKIE['carrinho'];
} else {
    $carrinho = array();
}

// Popular produtos do carrinho e salvar de volta na sessão
if (!empty($carrinho)) {
    foreach ($carrinho as $idProduto => $quantidade) {
        $produto = obterProduto($conn, $idProduto);
        $produto['quantidade'] = $quantidade;
        $produtosCarrinho[] = $produto;
    }
    $_SESSION['carrinho'] = $carrinho;
    setcookie('carrinho', serialize($carrinho), time() + (86400 * 30), "/");
}

function checkStock($conn)
{
    $sql = "SELECT QtEstoque FROM Produtos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['QtEstoque'] == 0) {
                echo "<p>Fora de estoque</p>";
            }
        }
    } else {
        echo "Não há produtos cadastrados.";
    }
}


$IDusuario = $_SESSION['IDuser'];

$sql = "SELECT Nome, dataNasc, Tel, Morada, CP FROM Usuarios WHERE IDuser = ?";
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
} else {
    $nome = '';
    $dataNasc = '';
    $tel = '';
    $morada = '';
    $Postal = '';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['Nome'], $_POST['dataNasci'], $_POST['Contacto'], $_POST['Morada'], $_POST['CodPostal'])) {
        $nome = $_POST['Nome'];
        $dataNasc = $_POST['dataNasci'];
        $tel = $_POST['Contacto'];
        $morada = $_POST['Morada'];
        $Postal = $_POST['CodPostal'];

        $sql = "UPDATE Usuarios SET Nome = ?, dataNasc = ?, Tel = ?, Morada = ?, CP = ? WHERE IDuser = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $nome, $dataNasc, $tel, $morada, $Postal, $IDusuario);

        if ($stmt->execute()) {
            echo '<script>window.alert("Os dados foram salvos.")</script>';
        } else {
            echo "Erro: " . $stmt->error;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('../connect_db.php');  // Insira o caminho correto para o seu arquivo de conexão do banco de dados

    $id = $_POST['id'];
    $nomeProduto = $_POST['NomeProduto'];
    $preco = $_POST['Preco'];
    $precoPromo = $_POST['PrecoPromo'];
    $qtEstoque = $_POST['QtEstoque'];

    $sql = "UPDATE Produtos SET NomeProduto=?, Preco=?, PrecoPromo=?, QtEstoque=? WHERE IDproduto=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sddii', $nomeProduto, $preco, $precoPromo, $qtEstoque, $id);

    if ($stmt->execute()) {
        echo '<script>alert("Produto atualizado"); window.location.href = "../pages/admPage.php";</script>';
    } else {
        echo '<script>alert("Erro ao atualizar produto"); window.location.href = "../pages/admPage.php";</script>';
    }

    $stmt->close();
    $conn->close();
}


/*function checkIdade($conn)
{
    $sql = "SELECT dataNasc FROM Usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nascimento = new DateTime($row['dataNasc']);
            $hoje   = new DateTime('hoje');
            $idade = $nascimento->diff($hoje)->y;

            if ($idade < 18) {
                echo "<script type='text/javascript'>alert('Erro: Usuário tem menos de 18 anos.');</script>";
            } else {
                echo "<script type='text/javascript'>alert('encomenda realizada com sucesso');</script>";
            }
        }
    } else {
        echo "0 resultados";
    }
}

checkIdade($conn);
$conn->close();
*/