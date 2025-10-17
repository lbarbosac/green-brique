<?php 
include_once './include/logado.php';
include_once './include/conn.php';
include_once './include/head.php';
?>

<main>
    <div class="container">
      <table>
        <th>ProdutoID</th>
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>Categoria</th>
        <th>Ações</th>
          <?php
            $sql = 'SELECT * FROM produtos;';
            $return = mysqli_query($conn, $sql);
            while($linha = mysqli_fetch_assoc($return)){
              echo '<tr>
                      <td>'.$linha['ProdutoID'].'</td>
                      <td>'.$linha['Nome'].'</td>
                      <td>'.$linha['Quantidade'].'</td>
                      <td>'.$linha['Preco'].'</td>
                      <td>'.$linha['CategoriaID'].'</td>
                      <td>
                        <a href="" class="btn btn-edit">Editar</a>
                        <a href="" class="btn btn-delete">Excluir</a>
                      </td>
                    </tr>';
            }
            ?>
      </table>

    </div>
  </main>
<?php 
include_once './include/footer.php';
?>