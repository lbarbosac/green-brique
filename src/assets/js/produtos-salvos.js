document.addEventListener('DOMContentLoaded', () => {
  const lista = document.getElementById('lista-salvos');
  const modal = document.getElementById('modal-excluir');
  const btnConfirmar = document.getElementById('confirmar-remocao');
  const btnCancelar = document.getElementById('cancelar-remocao');
  let idExcluir = null;

  function renderizarLista() {
    lista.innerHTML = "";
    const salvos = JSON.parse(localStorage.getItem('produtosSalvos') || "[]");
    if (salvos.length === 0) {
      lista.innerHTML = "<p>Você ainda não salvou nenhum produto.</p>";
      return;
    }

    salvos.forEach(produto => {
      const wrapper = document.createElement("div");
      wrapper.className = "produto-salvo";
      wrapper.setAttribute("tabindex", "0");
      wrapper.innerHTML = `
        <img src="${produto.img}" alt="Imagem do produto ${produto.nome}">
        <div class="produto-info">
          <a href="./info-produto.php?id=${produto.id}" class="produto-titulo">${produto.nome}</a>
        </div>
        <button class="btn-excluir" title="Remover produto" aria-label="Remover produto"
          data-id="${produto.id}">
          <i class="fa-solid fa-trash"></i>
        </button>
      `;
      lista.appendChild(wrapper);
    });

    document.querySelectorAll('.btn-excluir').forEach(btn => {
      btn.addEventListener('click', function(e){
        e.stopPropagation();
        idExcluir = this.getAttribute('data-id');
        abrirModal();
      });
    });
  }

  function abrirModal() {
    modal.style.display = "flex";
    modal.setAttribute("aria-hidden", "false");
    btnConfirmar.focus();
  }
  function fecharModal() {
    modal.style.display = "none";
    modal.setAttribute("aria-hidden", "true");
    idExcluir = null;
  }

  btnCancelar.addEventListener('click', fecharModal);
  modal.addEventListener('click', function(e){
    if(e.target === modal) fecharModal();
  });
  document.addEventListener('keydown', function(e){
    if (modal.style.display === "flex" && e.key === "Escape") fecharModal();
  });

  btnConfirmar.addEventListener('click', function(){
    if (idExcluir) {
      let salvos = JSON.parse(localStorage.getItem('produtosSalvos') || "[]");
      salvos = salvos.filter(item => item.id != idExcluir);
      localStorage.setItem('produtosSalvos', JSON.stringify(salvos));
      fecharModal();
      renderizarLista();
    }
  });

  renderizarLista();
});
