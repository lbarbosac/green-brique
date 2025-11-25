<?php 
include_once './include/conn.php';
include_once './include/head.php';

$nome = '';
$preco = '';
$quantidade = '';
$descricao = '';
$img = '';
$selected_subcategories = [];
$categorias = []; 
$id = 0; // Inicializa o ID

if(isset($_GET['id'])){
  $id = intval($_GET['id']);

  // 1. Busca o produto
  $sql_produto = 'SELECT ProdutoID, Img, Quantidade, Nome, Preco, Descricao
                   FROM produtos
                   WHERE ProdutoID = '.$id.';';
  $resultado_produto = mysqli_query($conn, $sql_produto);
  if ($resultado_produto && $row = mysqli_fetch_assoc($resultado_produto)) {
    $nome = htmlspecialchars($row['Nome']);
    $preco = htmlspecialchars($row['Preco']);
    $quantidade = htmlspecialchars($row['Quantidade']);
    $descricao = htmlspecialchars($row['Descricao']);
    $img = htmlspecialchars($row['Img']);
  }
  
  // 2. Busca os subfiltros já associados
  $sql_selected_subs = 'SELECT SubcategoriaID FROM produto_subcategoria WHERE ProdutoID = '.$id.';';
  $res_selected_subs = mysqli_query($conn, $sql_selected_subs);
  while($row_sub = mysqli_fetch_assoc($res_selected_subs)){
      $selected_subcategories[] = $row_sub['SubcategoriaID'];
  }
}

// 3. Busca todas as Categorias e Subcategorias para o formulário
$sql_categorias = 'SELECT c.CategoriaID, c.Nome AS CategoriaNome, s.SubcategoriaID, s.Nome AS SubcategoriaNome 
                   FROM categorias c
                   LEFT JOIN subcategorias s ON c.CategoriaID = s.CategoriaID
                   ORDER BY c.Nome, s.Nome;';
$res_categorias = mysqli_query($conn, $sql_categorias);

while($row = mysqli_fetch_assoc($res_categorias)){
    $cat_id = $row['CategoriaID'];
    if (!isset($categorias[$cat_id])) {
        $categorias[$cat_id] = [
            'Nome' => $row['CategoriaNome'],
            'Subcategorias' => []
        ];
    }
    if ($row['SubcategoriaID'] !== null) {
        $categorias[$cat_id]['Subcategorias'][] = [
            'ID' => $row['SubcategoriaID'],
            'Nome' => $row['SubcategoriaNome']
        ];
    }
}
?>
  <link rel="stylesheet" href="./assets/css/salvar-produtos.css">
  <main id="main-content">
    <div id="produtos-container">
        <form id="crud-form-produtos" action="./act/produtos.php" method="post">
            <input type="hidden" name="acao" value="salvar">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <h2 id="form-title">Cadastro de Produtos</h2>
            
            <label for="nome-produto" class="form-label">Nome do Produto</label>
            <input id="nome-produto" class="form-input" type="text" name="nome" placeholder="Nome do Produto" value="<?php echo $nome; ?>" required>

            <label for="img-produto" class="form-label">Url da Imagem</label>
            <input id="img-produto" class="form-input" type="text" name="img" placeholder="Url da Imagem do Produto" value="<?php echo $img; ?>" required>
            
            <label for="preco-produto" class="form-label">Preço</label>
            <input id="preco-produto" class="form-input" type="number" step="0.01" name="preco" placeholder="Preço" value="<?php echo $preco; ?>" required>
            
            <label for="quantidade-produto" class="form-label">Quantidade</label>
            <input id="quantidade-produto" class="form-input" type="number" name="quantidade" placeholder="Quantidade" value="<?php echo $quantidade; ?>" required>
            
            <label for="descricao-produto" class="form-label">Descrição</label>
            <textarea id="descricao-produto" class="form-input" name="descricao" placeholder="Descrição" required><?php echo $descricao; ?></textarea>
            
            <label for="select-filtros" class="form-label">Selecione os Filtros/Subcategorias (Segure CTRL/CMD para selecionar múltiplos)</label>
            
            <select id="select-filtros" name="subcategorias[]" multiple required>
                <?php foreach ($categorias as $categoria): ?>
                    <optgroup label="<?php echo htmlspecialchars($categoria['Nome']); ?>">
                        <?php foreach ($categoria['Subcategorias'] as $subcategoria): 
                            $selected = in_array($subcategoria['ID'], $selected_subcategories) ? 'selected' : '';
                        ?>
                            <option value="<?php echo $subcategoria['ID']; ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($subcategoria['Nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </optgroup>
                <?php endforeach; ?>
            </select>
            
            <button id="submit-button" type="submit">Salvar Produto</button>
        </form>
    </div>
  </main>

  <?php 
  include_once './include/footer.php';
  ?>