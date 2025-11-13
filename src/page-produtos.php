<?php 
include_once './include/conn.php';
include_once './include/head.php';

// 1. Lógica para Capturar o Filtro da URL
$subcat_id_filter = isset($_GET['subcat_id']) ? intval($_GET['subcat_id']) : 0;
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($conn, trim($_GET['query'])) : '';

// 2. Busca Categorias e Subcategorias para a barra lateral
$categorias = [];
$sql_categorias = 'SELECT c.CategoriaID, c.Nome AS CategoriaNome, s.SubcategoriaID, s.Nome AS SubcategoriaNome 
                   FROM categorias c
                   JOIN subcategorias s ON c.CategoriaID = s.CategoriaID
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
    $categorias[$cat_id]['Subcategorias'][] = [
        'ID' => $row['SubcategoriaID'],
        'Nome' => $row['SubcategoriaNome']
    ];
}

// 3. Lógica PHP para a Busca de Produtos
$sql_base = "SELECT p.* FROM produtos p";
$join_clause = "";
$where_clause = "";
$title = "Todos os Produtos";

if ($subcat_id_filter > 0) {
    // Filtra por Subcategoria
    $join_clause .= " JOIN produto_subcategoria ps ON p.ProdutoID = ps.ProdutoID";
    $where_clause .= " WHERE ps.SubcategoriaID = $subcat_id_filter";
    
    $sql_sub_name = "SELECT Nome FROM subcategorias WHERE SubcategoriaID = $subcat_id_filter";
    $res_sub_name = mysqli_query($conn, $sql_sub_name);
    $title = "Produtos na categoria: \"" . (mysqli_fetch_assoc($res_sub_name)['Nome'] ?? 'Filtro Selecionado') . "\"";

} elseif (!empty($search_query)) {
    // Filtra por busca na barra superior
    $where_clause .= " WHERE p.Nome LIKE '%$search_query%' OR p.Descricao LIKE '%$search_query%'";
    $title = "Resultado da busca por: \"" . htmlspecialchars($search_query) . "\"";
}

$sql = $sql_base . $join_clause . $where_clause . " GROUP BY p.ProdutoID"; // GROUP BY evita duplicatas
$retorno = mysqli_query($conn, $sql);

?>
    <link rel="stylesheet" href="./assets/css/page-produtos.css?v=<?php echo date("YmdHis").rand(0,9999999);?>">

    <main>
        <aside class="scrollable-filters">
            <img src="#" alt="">
            <nav>
                <h2 class="nav-title">Filtros:</h2>
                <ul id="container-filtros">
                    <li class="filtros">
                        <a class="filtro <?php echo ($subcat_id_filter == 0) ? 'active' : ''; ?>" href="./page-produtos.php">
                            <i class="fa-solid fa-arrow-trend-up"></i><span>Todos os Produtos</span>
                        </a>
                    </li>
                    <?php foreach ($categorias as $categoria): ?>
                        <li class="filtros">
                            <div class="nav-title" style="margin-top: 15px; font-size: 1rem; color: var(--acento-principal); font-weight: 700;">
                                <?php echo htmlspecialchars($categoria['Nome']); ?>
                            </div>
                            <?php foreach ($categoria['Subcategorias'] as $subcategoria): ?>
                                <?php 
                                    $active_class = ($subcat_id_filter == $subcategoria['ID']) ? 'active-filter' : '';
                                ?>
                                <a class="filtro <?php echo $active_class; ?>" 
                                   href="./page-produtos.php?subcat_id=<?php echo $subcategoria['ID']; ?>">
                                    <span><?php echo htmlspecialchars($subcategoria['Nome']); ?></span>
                                </a>
                            <?php endforeach; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </aside>

        <h1 class="search-title"><?php echo $title; ?></h1>

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
                <a id="produto-' . $produto_id . '" href="./info-produto.php?id=' . $produto_id . '" class="container-produto">
                    <div class="container-image-produto">
                        <img src="' . $img_url . '" alt="' . $nome_produto . '" class="image-produto">
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
        
        <script>
        $(document).ready(function() {
            const $searchInput = $('#search-input');
            const $suggestionsList = $('#suggestions-list');
            
            function hideSuggestions() {
                $suggestionsList.slideUp(100).empty();
            }
            
            $searchInput.on('keyup', function() {
                const query = $(this).val().trim(); 

                if (query.length < 3) { 
                    hideSuggestions(); 
                    return;
                }

                $.ajax({
                    url: './act/search-autocomplete.php', 
                    method: 'GET',
                    data: { query: query }, 
                    dataType: 'json', 
                    success: function(produtos) {
                        $suggestionsList.empty(); 
                        if (produtos.length > 0) {
                            produtos.slice(0, 8).forEach(function(produto) {
                                const highlightedName = produto.Nome.replace(
                                    new RegExp('(' + query + ')', 'gi'), 
                                    '<strong>$1</strong>'
                                );
                                
                                const $item = $(
                                    '<a href="./info-produto.php?id=' + produto.ProdutoID + '" class="suggestion-item">' + 
                                        highlightedName + 
                                    '</a>'
                                );
                                $suggestionsList.append($item);
                            });
                             $suggestionsList.slideDown(100); 
                        } else {
                            hideSuggestions();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Erro na busca de sugestões:", status, error);
                        hideSuggestions();
                    }
                });
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search-container').length) {
                    hideSuggestions();
                }
            });
        });
        </script>
    </main>
    <?php 
    include_once './include/footer.php'; 
    ?>