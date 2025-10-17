<?php 
include_once './include/logado.php';
include_once './include/conn.php';
include_once './include/head.php';
?>
 <main>
    <div class="container">
      <table>
        <th>CategoriaID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Ações</th>
        <tr>
          <td>1</td>
          <td>Nome</td>
          <td>desc</td>
          <td>
            <a href="" class="btn btn-edit">Editar</a>
            <a href="" class="btn btn-delete">Excluir</a>
          </td>
        </tr>
      </table>

    </div>
  </main>
<?php 
include_once './include/footer.php';
?>