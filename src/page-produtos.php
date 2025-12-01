<?php
include_once './include/conn.php';
include_once './include/head.php';

// Filtros da URL
$cat_id_filter = isset($_GET['cat_id']) ? intval($_GET['cat_id']) : 0;
$subcat_id_filter = isset($_GET['subcat_id']) ? intval($_GET['subcat_id']) : 0;
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($conn, trim($_GET['query'])) : '';

// Buscar categorias e subcategorias
$categorias = [];
$sql_categorias = 'SELECT c.CategoriaID, c.Nome AS CategoriaNome, s.SubcategoriaID, s.Nome AS SubcategoriaNome 
                   FROM categorias c
                   LEFT JOIN subcategorias s ON c.CategoriaID = s.CategoriaID
                   ORDER BY c.Nome, s.Nome;';
$res_categorias = mysqli_query($conn, $sql_categorias);

while ($row = mysqli_fetch_assoc($res_categorias)) {
    $cat_id = $row['CategoriaID'];
    if (!isset($categorias[$cat_id])) {
        $categorias[$cat_id] = [
            'Nome' => $row['CategoriaNome'],
            'Subcategorias' => []
        ];
    }
    if ($row['SubcategoriaID']) {
        $categorias[$cat_id]['Subcategorias'][] = [
            'ID' => $row['SubcategoriaID'],
            'Nome' => $row['SubcategoriaNome']
        ];
    }
}

// Consulta produtos conforme filtros e busca
$sql_base = "SELECT p.* FROM produtos p";
$join_clause = "";
$where_clause = "";
$title = "Todos os Produtos";

if ($subcat_id_filter > 0) {
    $join_clause .= " JOIN produto_subcategoria ps ON p.ProdutoID = ps.ProdutoID";
    $where_clause .= " WHERE ps.SubcategoriaID = $subcat_id_filter";

    $sql_sub_name = "SELECT Nome FROM subcategorias WHERE SubcategoriaID = $subcat_id_filter";
    $res_sub_name = mysqli_query($conn, $sql_sub_name);
    $title = "Produtos na subcategoria: \"" . (mysqli_fetch_assoc($res_sub_name)['Nome'] ?? 'Filtro Selecionado') . "\"";

} elseif ($cat_id_filter > 0) {
    $join_clause .= " JOIN produto_subcategoria ps ON p.ProdutoID = ps.ProdutoID
                     JOIN subcategorias s ON ps.SubcategoriaID = s.SubcategoriaID";
    $where_clause .= " WHERE s.CategoriaID = $cat_id_filter";

    $sql_cat_name = "SELECT Nome FROM categorias WHERE CategoriaID = $cat_id_filter";
    $res_cat_name = mysqli_query($conn, $sql_cat_name);
    $title = "Produtos na categoria: \"" . (mysqli_fetch_assoc($res_cat_name)['Nome'] ?? 'Filtro Selecionado') . "\"";

} elseif (!empty($search_query)) {
    $where_clause .= " WHERE p.Nome LIKE '%$search_query%' OR p.Descricao LIKE '%$search_query%'";
    $title = "Resultado da busca por: \"" . htmlspecialchars($search_query) . "\"";
}

$sql = $sql_base . $join_clause . $where_clause . " GROUP BY p.ProdutoID";
$retorno = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="./assets/css/page-produtos.css">

<main>
    <aside class="scrollable-filters" role="navigation" aria-label="Filtros de Categorias e Subcategorias">
        <h2 class="nav-title"><i class="fas fa-filter" aria-hidden="true"></i> Filtros</h2>
        <ul class="container-categorias" role="list">
            <!-- Todos os Produtos, ícone destacado -->
            <li class="categoria-item todos-produtos" id="container-opc-tds-produtos">
                <a href="./page-produtos.php" class="categoria-button" aria-current="<?php echo (!$cat_id_filter && !$subcat_id_filter) ? 'page' : 'false'; ?>">
                    <p id="opcao-todos-produtos">Todos os Produtos</p>
                </a>
            </li>

            <?php
            // Ícones para categorias (exemplos)
            $iconMap = [
                'Alimentos' => 'fas fa-apple-alt',
                'Roupas' => 'fas fa-tshirt',
                'Utensílios' => 'fas fa-blender',
            ];
            ?>

            <?php foreach ($categorias as $id => $categoria): ?>
            <li class="categoria-item" data-catid="<?php echo $id; ?>" role="listitem">
                <button class="categoria-button" aria-expanded="false" aria-controls="subcat-list-<?php echo $id; ?>" aria-haspopup="true">
                    <i class="<?php echo $iconMap[$categoria['Nome']] ?? 'fas fa-folder'; ?>" aria-hidden="true"></i>
                    <span><?php echo htmlspecialchars($categoria['Nome']); ?></span>
                </button>

                <ul id="subcat-list-<?php echo $id; ?>" class="subcategoria-list" hidden>
                    <?php foreach ($categoria['Subcategorias'] as $subcat): ?>
                    <li>
                        <a href="./page-produtos.php?subcat_id=<?php echo $subcat['ID']; ?>" class="subcategoria-link" tabindex="0">
                            <?php echo htmlspecialchars($subcat['Nome']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>

            </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <section class="search-section" aria-live="polite" aria-atomic="true">
        <h1 class="search-title"><?php echo $title; ?></h1>

        <div class="search-bar-container geral-search" role="search" aria-label="Busca geral de produtos">
            <form action="./page-produtos.php" method="get">
                <input type="text" id="search-input" name="query" placeholder="Buscar produtos..." autocomplete="off" aria-autocomplete="list" aria-controls="autocomplete-list" aria-haspopup="listbox" aria-expanded="false" value="<?php echo htmlspecialchars($search_query); ?>" />
                <ul id="autocomplete-list" role="listbox" aria-label="Sugestões de produtos" hidden></ul>
            </form>
        </div>

        <div id="container-produtos">
            <?php
            if ($retorno && mysqli_num_rows($retorno) > 0) {
                while ($linha = mysqli_fetch_assoc($retorno)) {
                    $produto_id = htmlspecialchars($linha['ProdutoID']);
                    $img_url = htmlspecialchars($linha['Img']);
                    $nome_produto = htmlspecialchars($linha['Nome']);
                    $descricao_produto = htmlspecialchars($linha['Descricao']);
                    $preco_formatado = number_format($linha['Preco'], 2, ',', '.');
                    echo '
                    <a id="produto-' . $produto_id . '" href="./info-produto.php?id=' . $produto_id . '" class="container-produto" tabindex="0">
                        <div class="container-image-produto">
                            <img src="' . $img_url . '" alt="Imagem do produto ' . $nome_produto . '" class="image-produto" loading="lazy">
                        </div>
                        <div class="container-nome-produto">
                            <h2 class="nome-produto">' . $nome_produto . '</h2>
                        </div>
                        <div class="container-descricao-produto">
                            <h3 class="descricao-produto">' . $descricao_produto . '</h3>
                        </div>
                        <div class="container-preco-produto">
                            <h2 class="preco-produto">R$ ' . $preco_formatado . '</h2>
                        </div>
                    </a>';
                }
            } else {
                echo "<p class='mensagem-aviso'>Nenhum produto encontrado. Tente outra palavra-chave ou filtro.</p>";
            }
            ?>
        </div>
    </section>
</main>

<script defer src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="./assets/js/page-produtos.js?v=<?php echo date("YmdHis"); ?>"></script>

<?php
include_once './include/footer.php';
?>
