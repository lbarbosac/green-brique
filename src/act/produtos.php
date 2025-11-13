<?php
include_once '../include/conn.php'; 

if (!isset($_POST['acao']) || $_POST['acao'] != 'salvar') {
    header('Location: ../admin.php'); 
    exit;
}

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
// Usando 'real_escape_string' para segurança básica, idealmente use Prepared Statements (mysqli::prepare)
$nome = mysqli_real_escape_string($conn, $_POST['nome']);
$preco = floatval($_POST['preco']);
$quantidade = intval($_POST['quantidade']);
$descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
$img = mysqli_real_escape_string($conn, $_POST['img']);
$subcategorias_ids = isset($_POST['subcategorias']) ? $_POST['subcategorias'] : [];

// 1. Salva ou Atualiza o Produto
if ($id > 0) {
    // Atualizar
    $sql = "UPDATE produtos SET Nome='$nome', Descricao='$descricao', Preco='$preco', Quantidade='$quantidade', Img='$img' WHERE ProdutoID=$id";
} else {
    // Inserir
    $sql = "INSERT INTO produtos (Nome, Descricao, Preco, Quantidade, Img) VALUES ('$nome', '$descricao', '$preco', '$quantidade', '$img')";
}

if (mysqli_query($conn, $sql)) {
    $produto_id = ($id > 0) ? $id : mysqli_insert_id($conn);
    
    // 2. Sincronização de Filtros (Subcategorias)
    if ($produto_id > 0) {
        // A. Limpa todas as subcategorias existentes para o produto
        $sql_delete_subs = "DELETE FROM produto_subcategoria WHERE ProdutoID = $produto_id";
        mysqli_query($conn, $sql_delete_subs);

        // B. Insere as novas subcategorias selecionadas
        if (!empty($subcategorias_ids)) {
            $values = [];
            $valid_subs = [];

            foreach ($subcategorias_ids as $sub_id) {
                // Garante que é um ID de subcategoria válido (inteiro > 0)
                $sub_id = intval($sub_id);
                if ($sub_id > 0) {
                    $values[] = "($produto_id, $sub_id)";
                }
            }
            
            if (!empty($values)) {
                $sql_insert_subs = "INSERT INTO produto_subcategoria (ProdutoID, SubcategoriaID) VALUES " . implode(", ", $values);
                mysqli_query($conn, $sql_insert_subs);
            }
        }
    }

    if (!isset($conn) || !$conn) {
        // Se a conexão falhou, retorna erro
        header('Location: ../admin.php?status=error&msg='.urlencode("Erro de conexão com o banco de dados."));
        exit;
    }
    
    if (!isset($_POST['acao']) || $_POST['acao'] != 'salvar') {
        header('Location: ../admin.php'); 
        exit;
    }

    // Sucesso
    header('Location: ../perfil.php?status=success&msg='.urlencode("Produto salvo com sucesso.")); 
    exit;
} else {
    // Erro
    header('Location: ../admin.php?status=error&msg='.urlencode("Erro no banco de dados: " . mysqli_error($conn)));
    exit;
}
?>