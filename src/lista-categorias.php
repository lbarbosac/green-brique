<?php 
// include dos arquivos
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/head.php';
?>

<main>

<div class="container">
    <?php if (isset($_GET['erro']) && $_GET['erro'] === 'categoria_em_uso'): ?>
      <div class="alert alert-error">
        A categoria não pode ser excluída porque está sendo utilizada em outra tabela.
      </div>
    <?php endif; ?>
    <h1>Lista de Categorias</h1>
    <a href="./salvar-categorias.php" class="btn btn-add">Incluir</a>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
      <?php
            // montando o SQL que seá executado no banco de dados
            $sql = 'SELECT * FROM categorias
            ORDER BY CategoriaID ASC;';

            // executar o SQL e guardar o retorno
            $return = mysqli_query($conexao, $sql);

            //listar todos os dados
            while($linha = mysqli_fetch_assoc($return)){
                echo '<tr id="'.$linha['CategoriaID'].'">
          <td>'.$linha['CategoriaID'].'</td>
          <td>'.$linha['Nome'].'</td>

          <td>
            <a href="./salvar-categorias.php?id='.$linha['CategoriaID'].'" class="btn btn-edit">Editar</a>
            <a href="./action/categorias.php?id='.$linha['CategoriaID'].'&acao=excluir" class="btn btn-delete">Excluir</a>
          </td>
        </tr>';
            };
            ?>   
      </tbody>
    </table>
  </div>



</main>

<?php 
// include dos arquivos
include_once './include/footer.php';
?>