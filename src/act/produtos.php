<?php
// include dos arquivos
include_once   '../include/logado.php';
include_once   '../include/conn.php';

// captura a acao dos dados
$acao = $_REQUEST['acao'] ?? '';
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

// validacao
switch ($acao) {
    case 'excluir':
        $sql = 'DELETE FROM produtos WHERE ProdutoID = '.$id;
        if (mysqli_query($conn, $sql)) {
            header("Location: ../perfil.php?sucesso=produto_excluido");
        } else {
            header("Location: ../perfil.php?erro=produto_nao_excluido");
        }
        break;

    case 'salvar':
        $nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $preco = mysqli_real_escape_string($conn, $_POST['preco']);
        $quantidade = mysqli_real_escape_string($conn, $_POST['quantidade']);
        $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
        $img = mysqli_real_escape_string($conn, $_POST['img']);

        if ($id > 0) {
            $sql = "UPDATE produtos 
                    SET Nome = '$nome', Preco = '$preco', Quantidade = '$quantidade', Descricao = '$descricao', Img = '$img'
                    WHERE ProdutoID = $id";
        } else {
            $sql = "INSERT INTO produtos (Nome, Preco, Quantidade, Descricao) 
                    VALUES ('$nome', '$preco', '$quantidade', '$descricao')";
        }

        if (!mysqli_query($conn, $sql)) {
            die("Erro ao salvar o produto: " . mysqli_error($conn));
        }

        header("Location: ../perfil.php");
        break;

    default:
        break;
}
?>