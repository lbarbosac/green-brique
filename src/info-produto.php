<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Info produto</title>
  <link rel="stylesheet" href="./assets/css/info-produto.css"/>
</head>
<body>
  <main class="container">
    <figure class="imagem-produto-container">
      <!-- 
       <img 
        src="<?= htmlspecialchars($produto['imagem'] ?? 'https://via.placeholder.com/400x300?text=Sem+Imagem'); ?>" 
        alt="Imagem do produto <?= htmlspecialchars($produto['nome'] ?? 'produto'); ?>" 
        class="imagem-produto" 
        loading="lazy"
      />
      -->
      <img src="https://production.autoforce.com/uploads/version/profile_image/11035/model_main_webp_comprar-platinum-c-teto-solar_6eb208799e.png.webp" alt="" class="imagem-produto">
    </figure>
    <section class="info-produto">
    <!-- 
      <h2 class="nome-produto"><?= htmlspecialchars($produto['nome'] ?? 'Nome do Produto'); ?></h2>
      <p class="descricao-produto"><?= nl2br(htmlspecialchars($produto['descricao'] ?? 'Descrição do produto aqui...')); ?></p>
      <a href="#" id="link-falar-vendedor" class="link-acao">Falar com o vendedor</a>
    -->
      <h2 class="nome-produto">Carro veloz e furioso</h2>
      <p class="descricao-produto">Completo em segurança, com alertas de colisão frontal, assistente de permanência em faixa e 6 airbags.
      </p>
      <a href="#" id="info-vendedor" class="link-acao">Informações do vendedor</a>
    </section>
    <aside class="controles">
      <!-- 
       <div class="preco">R$ <?= number_format($produto['preco'] ?? 0, 2, ',', '.'); ?></div>
      -->
      <div class="preco">R$ 50,00</div>
      
      <h3>Fale com o vendedor via chat</h3>
      <button id="botao-chat" class="btn-primario">Este produto está disponível?</button>

      <div class="seletor-quantidade" role="group" aria-label="Selecionar quantidade">
        <button id="diminuir-qtd" aria-label="Diminuir quantidade">−</button>
        <span id="quantidade-valor">1 unidade</span>
        <button id="aumentar-qtd" aria-label="Aumentar quantidade">+</button>
      </div>
    </aside>
  </main>
  <script src="./assets/js/info-produto.js"></script>
</body>
</html>