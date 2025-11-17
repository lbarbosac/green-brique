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
