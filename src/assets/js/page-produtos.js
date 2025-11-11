const categorias = {
    "Roupas": ["Usadas", "Novas", "Em promoção", "Mais Vendidas"],
    "Utensílios": ["Cozinha", "Limpeza", "Escritório", "Promoção"],
    "Alimentos": ["Frescos", "Congelados", "Snacks", "Orgânicos"]
};

// Cria mini-filtros (retorna o elemento)
function criarMiniFiltros(liElemento, categoria) {
    const filtrosDiv = document.createElement("div");
    filtrosDiv.className = "mini-filtros";
    filtrosDiv.setAttribute("role", "list");    

    categorias[categoria].forEach(texto => {
        const item = document.createElement("div");
        item.className = "filtro-item";
        item.textContent = texto;
        item.setAttribute("tabindex", "0");
        item.setAttribute("role", "listitem");

        // hover visual e acessibilidade
        item.addEventListener("mouseover", () => item.style.backgroundColor = "var(--acento-principal)");
        item.addEventListener("mouseout", () => item.style.backgroundColor = "transparent");
        item.addEventListener("focus", () => item.style.backgroundColor = "var(--acento-principal)");
        item.addEventListener("blur", () => item.style.backgroundColor = "transparent");

        // Clique (substitua pela ação real)
        item.addEventListener("click", () => {
            alert(`Filtrado por: ${categoria} - ${texto}`);
        });

        filtrosDiv.appendChild(item);
    });

    liElemento.insertAdjacentElement("afterend", filtrosDiv);

    // animação suave
    filtrosDiv.style.height = "0px";
    filtrosDiv.style.overflow = "hidden";
    filtrosDiv.style.transition = "height 0.3s ease, opacity 0.3s ease";
    filtrosDiv.style.opacity = "0";

    requestAnimationFrame(() => {
        filtrosDiv.style.height = filtrosDiv.scrollHeight + "px";
        filtrosDiv.style.opacity = "1";
    });

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

        let miniFiltrosFixados = null;
        let miniFiltrosHover = null;

        // Hover temporário
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

        // Clique para fixar
        span.addEventListener("click", () => {
            if (miniFiltrosFixados) {
                fecharMiniFiltros(miniFiltrosFixados);
                miniFiltrosFixados = null;
                return;
            }
            if (miniFiltrosHover) {
                miniFiltrosFixados = miniFiltrosHover;
                miniFiltrosHover = null;
            } else {
                miniFiltrosFixados = criarMiniFiltros(liElemento, categoria);
            }
        });

        // Permitir foco e ativar o clique com enter ou espaço (acessibilidade)
        span.parentElement.setAttribute("tabindex", "0");
        span.parentElement.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                span.click();
            }
        });
    });
}

// Inicializa quando DOM estiver pronto
document.addEventListener("DOMContentLoaded", initFiltros);
