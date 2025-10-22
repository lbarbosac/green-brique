
console.log("Página de Produtos - Low Carbo");

// Mini-filtros por categoria
const categorias = {
    "Roupas": ["Usadas", "Novas", "Em promoção", "Mais Vendidas"],
    "Utensílios": ["Cozinha", "Limpeza", "Escritório", "Promoção"],
    "Alimentos": ["Frescos", "Congelados", "Snacks", "Orgânicos"]
};

// Cria mini-filtros (retorna o elemento)
function criarMiniFiltros(liElemento, categoria) {
    const filtrosDiv = document.createElement("div");
    filtrosDiv.className = "mini-filtros";

    categorias[categoria].forEach(texto => {
        const item = document.createElement("div");
        item.className = "filtro-item";
        item.textContent = texto;

        // hover visual
        item.addEventListener("mouseover", () => item.style.background = "#8a2be2");
        item.addEventListener("mouseout", () => item.style.background = "transparent");

        // clique (substitua pela ação real)
        item.addEventListener("click", () => alert(`Você clicou em: ${texto}`));

        filtrosDiv.appendChild(item);
    });

    liElemento.insertAdjacentElement("afterend", filtrosDiv);

    // animação suave
    filtrosDiv.style.height = "0px";
    filtrosDiv.style.overflow = "hidden";
    filtrosDiv.style.transition = "height 0.3s ease, opacity 0.3s ease";
    filtrosDiv.style.opacity = "0";

    setTimeout(() => {
        filtrosDiv.style.height = filtrosDiv.scrollHeight + "px";
        filtrosDiv.style.opacity = "1";
    }, 10);

    return filtrosDiv;
}

// Fecha mini-filtros
function fecharMiniFiltros(filtrosDiv) {
    filtrosDiv.style.height = "0px";
    filtrosDiv.style.opacity = "0";
    setTimeout(() => filtrosDiv.remove(), 300);
}

// Inicializa eventos para todos os filtros
function initFiltros() {
    const spansFiltros = document.querySelectorAll("#container-filtros span");

    spansFiltros.forEach(span => {
        const categoria = span.textContent.trim();
        const liElemento = span.closest("li");

        // Cada li terá seu próprio estado
        let miniFiltrosFixados = null;
        let miniFiltrosHover = null;

        // --- Hover temporário ---
        span.addEventListener("mouseenter", () => {
            if (miniFiltrosFixados || miniFiltrosHover) return;

            miniFiltrosHover = criarMiniFiltros(liElemento, categoria);

            liElemento.addEventListener("mouseleave", () => {
                if (!miniFiltrosFixados && miniFiltrosHover) {
                    fecharMiniFiltros(miniFiltrosHover);
                    miniFiltrosHover = null;
                }
            }, { once: true });
        });

        // --- Clique para fixar ---
        span.addEventListener("click", () => {
            // Se já existe fixo, fecha
            if (miniFiltrosFixados) {
                fecharMiniFiltros(miniFiltrosFixados);
                miniFiltrosFixados = null;
                return;
            }

            // Se hover aberto, transforma em fixo
            if (miniFiltrosHover) {
                miniFiltrosFixados = miniFiltrosHover;
                miniFiltrosHover = null;
            } else {
                // cria novo fixo
                miniFiltrosFixados = criarMiniFiltros(liElemento, categoria);
            }
        });
    });
}

// Inicializa quando DOM estiver pronto
document.addEventListener("DOMContentLoaded", initFiltros);