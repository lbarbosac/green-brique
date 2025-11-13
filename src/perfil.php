<?php 
include_once './include/logado.php';
include_once './include/conn.php';
include_once './include/head.php';
?>

<main>
<div class="perfil">
  <div class="foto-nome">
    <img class="img-perfil" src="https://gcomp.devpampa.com/fotos/times/time_759/jogadores/18268_1684415809422.png" alt="">
    <h2 class="nome">Leonardo Vargas Saldanha</h2>
  </div>
  <div>
    <button class="botao-perfil">Editar Perfil</button>
  </div>
</div>

</div>
  <div class="container">
    <a href="./salvar-produtos.php" class="btn btn-add">Adicionar produto</a>
    <table>
    <th>ProdutoID</th>
    <th>Nome</th>
    <th>Quantidade</th>
    <th>Preço</th>
    <th>Ações</th>
      <?php
        $sql = 'SELECT * FROM produtos;';
        $return = mysqli_query($conn, $sql);
        while($linha = mysqli_fetch_assoc($return)){
          echo '<tr id="'.$linha['ProdutoID'].'">
                  <td>'.$linha['ProdutoID'].'</td>
                  <td>'.$linha['Nome'].'</td>
                  <td>'.$linha['Quantidade'].'</td>
                  <td>'.'R$ '.number_format($linha['Preco'], 2, ',', '.').'</td>
                  <td>
                    <a href="./salvar-produtos.php?id='.$linha['ProdutoID'].'" class="btn btn-edit">Editar</a>
                    <a href="./act/produtos.php?id='.$linha['ProdutoID'].'&acao=excluir" class="btn btn-delete">Excluir</a>
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