document.addEventListener('DOMContentLoaded', () => {

    // Ícones para expandir/collapsar nas categorias
    const categoriaButtons = document.querySelectorAll('.categoria-button:not(.todos-produtos a)');
    categoriaButtons.forEach(button => {

        // Inserir símbolo de + / - ao lado direito dinamicamente
        const iconSpan = document.createElement('span');
        iconSpan.classList.add('expand-icon');
        iconSpan.textContent = '+';
        iconSpan.style.marginLeft = 'auto';
        iconSpan.style.fontWeight = '900';
        iconSpan.style.fontSize = '1.3rem';
        button.appendChild(iconSpan);

        button.addEventListener('click', () => {
            const expanded = button.getAttribute('aria-expanded') === 'true';

            // Fechar todas as categorias abertas
            categoriaButtons.forEach(btn => {
                btn.setAttribute('aria-expanded', 'false');
                btn.querySelector('.expand-icon').textContent = '+';
                const sublist = document.getElementById(btn.getAttribute('aria-controls'));
                const form = btn.parentElement.querySelector('.categoria-busca');
                if (sublist) sublist.classList.remove('expanded');
                if (sublist) sublist.hidden = true;
                if (form) form.hidden = true;
            });

            if (!expanded) {
                button.setAttribute('aria-expanded', 'true');
                button.querySelector('.expand-icon').textContent = '−';
                const sublist = document.getElementById(button.getAttribute('aria-controls'));
                const form = button.parentElement.querySelector('.categoria-busca');
                if (sublist) {
                    sublist.hidden = false;
                    sublist.classList.add('expanded');
                }
                if (form) form.hidden = false;
            }
        });
    });

    // Autocomplete na barra de busca geral
    const input = document.getElementById('search-input');
    const autocompleteList = document.getElementById('autocomplete-list');

    if (input) {
        let activeIndex = -1;

        input.addEventListener('input', () => {
            const query = input.value.trim();

            if (query.length < 2) {
                autocompleteList.innerHTML = '';
                autocompleteList.hidden = true;
                input.setAttribute('aria-expanded', 'false');
                return;
            }

            fetch(`./include/produto_autocomplete.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(results => {
                    autocompleteList.innerHTML = '';
                    activeIndex = -1;

                    if (results.length === 0) {
                        autocompleteList.hidden = true;
                        input.setAttribute('aria-expanded', 'false');
                        return;
                    }

                    results.forEach((item, index) => {
                        const li = document.createElement('li');
                        li.setAttribute('role', 'option');
                        li.setAttribute('id', `autocomplete-item-${index}`);
                        li.innerHTML = `<img src="${item.Img}" alt="Imagem do produto ${item.Nome}" /> <span>${item.Nome}</span>`;

                        li.addEventListener('click', () => {
                            window.location.href = `./info-produto.php?id=${item.ProdutoID}`;
                        });

                        autocompleteList.appendChild(li);
                    });

                    autocompleteList.hidden = false;
                    input.setAttribute('aria-expanded', 'true');
                })
                .catch(() => {
                    autocompleteList.innerHTML = '';
                    autocompleteList.hidden = true;
                    input.setAttribute('aria-expanded', 'false');
                });
        });

        input.addEventListener('keydown', (e) => {
            const items = autocompleteList.querySelectorAll('li');
            if (items.length === 0) return;

            switch (e.key) {
                case 'ArrowDown':
                    e.preventDefault();
                    activeIndex = (activeIndex + 1) % items.length;
                    setActive(items, activeIndex);
                    break;
                case 'ArrowUp':
                    e.preventDefault();
                    activeIndex = (activeIndex - 1 + items.length) % items.length;
                    setActive(items, activeIndex);
                    break;
                case 'Enter':
                    e.preventDefault();
                    if (activeIndex > -1) {
                        items[activeIndex].click();
                    }
                    break;
                case 'Escape':
                    autocompleteList.innerHTML = '';
                    autocompleteList.hidden = true;
                    input.setAttribute('aria-expanded', 'false');
                    break;
            }
        });

        function setActive(items, index) {
            items.forEach(item => item.setAttribute('aria-selected', 'false'));
            const activeItem = items[index];
            if (activeItem) {
                activeItem.setAttribute('aria-selected', 'true');
                activeItem.scrollIntoView({block: 'nearest'});
            }
        }

        // Fecha sugestões clicando fora
        document.addEventListener('click', (e) => {
            if (!input.contains(e.target) && !autocompleteList.contains(e.target)) {
                autocompleteList.innerHTML = '';
                autocompleteList.hidden = true;
                input.setAttribute('aria-expanded', 'false');
            }
        });
    }
});
