<?php include_once './include/head.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtos Salvos</title>
  <link rel="stylesheet" href="./assets/css/produtos-salvos.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <main class="container-salvos">
    <h2>Produtos Salvos</h2>
    <section id="lista-salvos" aria-live="polite"></section>
  </main>
  <div id="modal-excluir" class="modal-excluir" aria-modal="true" role="dialog" aria-labelledby="modalTitulo" tabindex="-1" style="display:none;">
    <div class="modal-content">
      <h3 id="modalTitulo">Remover produto dos salvos?</h3>
      <p id="modalTexto">Tem certeza que deseja remover este produto da sua lista de salvos?</p>
      <div class="modal-actions">
        <button class="btn-confirmar-exclusao" id="confirmar-remocao">Sim, remover</button>
        <button class="btn-cancelar-exclusao" id="cancelar-remocao">Cancelar</button>
      </div>
    </div>
  </div>

  <script src="./assets/js/produtos-salvos.js"></script>
</body>
</html>
