<?php 
// include dos arquivox
include_once './include/logado.php';
include_once './include/conn.php';
include_once './include/head.php';

$nome = '';
$preco = '';
$descricao = '';

if(isset($_GET['id'])){
  $id = intval($_GET['id']);

  // busca o produto específico e suas informações
  $sql = "SELECT ProdutoID, Nome, Preco, Descricao
          FROM produtos AS p
          WHERE ProdutoID = $id
          LIMIT 1";

  $resultado = mysqli_query($conn, $sql);
  if ($resultado) {
    $row = mysqli_fetch_assoc($resultado);
    if ($row) {
      $nome = isset($row['Nome']) ? $row['Nome'] : '';
      $preco = isset($row['Preco']) ? $row['Preco'] : '';
      $descricao = isset($row['Descricao']) ? $row['Descricao'] : '';
    }
  }

}
?>
  
  <main>

    <div id="produtos" class="tela">
        <form class="crud-form" action="./action/produtos.php" method="post">
        <input type="hidden" name="acao" value="salvar">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
          <h2>Cadastro de Produtos</h2>
          
          <label for="nome-produto" class="form-label">Nome do Produto</label>
          <input id="nome-produto" class="form-input" type="text" name="nome" placeholder="Nome do Produto" value="<?php echo htmlspecialchars($nome); ?>" required>
          
          <label for="preco-produto" class="form-label">Preço</label>
          <input id="preco-produto" class="form-input" type="number" step="0.01" name="preco" placeholder="Preço" value="<?php echo htmlspecialchars($preco); ?>" required>
          
          <label for="descricao-produto" class="form-label">Descrição</label>
          <textarea id="descricao-produto" class="form-textarea" name="descricao" placeholder="Descrição" required><?php echo htmlspecialchars($descricao); ?></textarea>
          
          <button class="form-button" type="submit">Salvar</button>
        </form>
    </div>
  </main>

  <?php 
  // include dos arquivox
  include_once './include/footer.php';
  ?>