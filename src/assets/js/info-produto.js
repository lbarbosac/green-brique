document.addEventListener('DOMContentLoaded', () => {
  const botaoSalvar = document.getElementById('btn-salvar-produto');
  const iconeSalvar = document.getElementById('icone-salvo');
  const produtoId = document.querySelector('[data-produto-id]').dataset.produtoId;
  const produtoNome = document.querySelector('.nome-produto').textContent;
  const produtoImg = document.querySelector('.imagem-produto').src;

  // Usar localStorage para produtos salvos
  function produtoEstaSalvo(id) {
    const salvos = JSON.parse(localStorage.getItem('produtosSalvos') || "[]");
    return salvos.some(item => item.id == id);
  }

  function salvarProduto(id, nome, img) {
    let salvos = JSON.parse(localStorage.getItem('produtosSalvos') || "[]");
    if (!salvos.some(item => item.id == id)) {
      salvos.push({ id, nome, img });
      localStorage.setItem('produtosSalvos', JSON.stringify(salvos));
    }
  }

  function removerProduto(id) {
    let salvos = JSON.parse(localStorage.getItem('produtosSalvos') || "[]");
    salvos = salvos.filter(item => item.id != id);
    localStorage.setItem('produtosSalvos', JSON.stringify(salvos));
  }

  function atualizarEstadoBotao() {
    if (produtoEstaSalvo(produtoId)) {
      botaoSalvar.classList.add('salvo');
      iconeSalvar.classList.remove('fa-regular');
      iconeSalvar.classList.add('fa-solid');
      iconeSalvar.style.color = "#2D5D34";
      botaoSalvar.setAttribute("aria-label", "Remover dos salvos");
    } else {
      botaoSalvar.classList.remove('salvo');
      iconeSalvar.classList.remove('fa-solid');
      iconeSalvar.classList.add('fa-regular');
      iconeSalvar.style.color = "";
      botaoSalvar.setAttribute("aria-label", "Salvar este produto");
    }
  }

  // Efeito hover no botão salvar já é feito pelo CSS

  botaoSalvar.addEventListener('click', () => {
    if (produtoEstaSalvo(produtoId)) {
      removerProduto(produtoId);
    } else {
      salvarProduto(produtoId, produtoNome, produtoImg);
    }
    atualizarEstadoBotao();
  });

  // Estado inicial
  atualizarEstadoBotao();
});

document.addEventListener('DOMContentLoaded', () => {
  const botaoChat = document.getElementById('botao-chat');
  const linkVendedor = document.getElementById('info-vendedor');

  botaoChat.addEventListener('click', (e) => {
    e.preventDefault(); // Evita comportamento padrão do botão/link

    // Se o alerta não estiver ativo, adiciona a classe de alerta e dá foco no link vendedor
    if (!linkVendedor.classList.contains('link-alerta')) {
      linkVendedor.classList.add('link-alerta');
      linkVendedor.focus(); // Foca para acessibilidade e sinal visual

      // Remove a classe de alerta após 5 segundos para não ficar permanante
      setTimeout(() => {
        linkVendedor.classList.remove('link-alerta');
      }, 5000);
    }
  });
});
