<?php 
include_once './include/conn.php';
include_once './include/head.php'; 

// 1. Lógica PHP para a Pesquisa COMPLETA
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($conn, trim($_GET['query'])) : '';

$sql_base = "SELECT * FROM produtos";
$where_clause = "";

if (!empty($search_query)) {
    $where_clause = " WHERE Nome LIKE '%$search_query%' OR Descricao LIKE '%$search_query%'";
    echo '<h1 class="search-title">Resultado da busca por: "' . htmlspecialchars($search_query) . '"</h1>';
} else {
    echo '<h1 class="search-title">Todos os Produtos</h1>';
}

$sql = $sql_base . $where_clause;
$retorno = mysqli_query($conn, $sql);

?>
    <link rel="stylesheet" href="./assets/css/page-produtos.css?v=<?php echo date("YmdHis").rand(0,9999999);?>">

    <main>
        <aside class="scrollable-filters">
            <img src="#" alt="">
            <nav>
                <h2 class="nav-title">Filtros:</h2>
                <ul id="container-filtros">
                    <li class="filtros"><div class="filtro"><i class="fa-solid fa-arrow-trend-up"></i><span>Todos</span></div></li>
                    <li class="filtros"><div class="filtro"><i class="fa-solid fa-arrow-trend-up"></i><span>Roupas</span></div></li>
                    <li class="filtros"><div class="filtro"><i class="fa-solid fa-arrow-trend-up"></i><span>Utensílios</span></div></li>
                    <li class="filtros"><div class="filtro"><i class="fa-solid fa-arrow-trend-up"></i><span>Alimentos</span></div></li>
                </ul>
            </nav>
        </aside>

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
            echo "<p class='mensagem-aviso'>Nenhum produto encontrado";
            if (!empty($search_query)) {
                 echo " para a busca **\"" . htmlspecialchars($search_query) . "\"**";
            }
            echo ". Tente outra palavra-chave.</p>";
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
                    url: './act/search-autocomplete.php', // Caminho funcional
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
        <script src="./assets/js/page-produtos.js"></script>
    </main>
    <?php 
    include_once './include/footer.php'; 
    ?>
</body>
</html>