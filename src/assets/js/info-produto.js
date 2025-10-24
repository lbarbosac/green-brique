document.addEventListener('DOMContentLoaded', () => {
    const botaoDiminuir = document.getElementById('diminuir-qtd');
    const botaoAumentar = document.getElementById('aumentar-qtd');
    const valorQuantidade = document.getElementById('quantidade-valor');
  
    let quantidade = 1;
  
    function atualizarQuantidade() {
      valorQuantidade.textContent = quantidade + (quantidade === 1 ? ' unidade' : ' unidades');
    }
  
    botaoDiminuir.addEventListener('click', () => {
      if (quantidade > 1) {
        quantidade--;
        atualizarQuantidade();
      }
    });
  
    botaoAumentar.addEventListener('click', () => {
      quantidade++;
      atualizarQuantidade();
    });
  
    document.getElementById('link-falar-vendedor').addEventListener('click', e => {
      e.preventDefault();
      alert('Funcionalidade de falar com o vendedor será implementada no backend.');
    });
  
    document.getElementById('botao-chat').addEventListener('click', () => {
      alert('Verificando disponibilidade do produto...');
    });
  
    // Atualiza o texto inicial da quantidade
    atualizarQuantidade();
  });