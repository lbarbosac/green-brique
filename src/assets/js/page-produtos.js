document.addEventListener('DOMContentLoaded', () => {

    // --- Lógica do Menu Lateral Responsivo (Sidebar) ---
    const menuToggleBtn = document.getElementById('menu-toggle-btn');
    const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    
    const toggleSidebar = () => {
        const isExpanded = menuToggleBtn.getAttribute('aria-expanded') === 'true';

        if (isExpanded) {
            // Fechar Sidebar
            sidebar.classList.remove('active');
            menuToggleBtn.setAttribute('aria-expanded', 'false');
            menuToggleBtn.querySelector('i').className = 'fa-solid fa-bars';
            overlay.hidden = true;
            document.body.classList.remove('noscroll');
        } else {
            // Abrir Sidebar
            sidebar.classList.add('active');
            menuToggleBtn.setAttribute('aria-expanded', 'true');
            menuToggleBtn.querySelector('i').className = 'fa-solid fa-xmark';
            overlay.hidden = false;
            document.body.classList.add('noscroll');
        }
    };


    if (menuToggleBtn && sidebar && overlay) {
        // Evento principal para abrir/fechar
        menuToggleBtn.addEventListener('click', toggleSidebar);

        // Fechar ao clicar no overlay
        overlay.addEventListener('click', toggleSidebar);

        // Fechar ao redimensionar (volta para o estado desktop)
        const checkDesktopResize = () => {
            if (window.innerWidth > 768 && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                menuToggleBtn.setAttribute('aria-expanded', 'false');
                menuToggleBtn.querySelector('i').className = 'fa-solid fa-bars';
                overlay.hidden = true;
                document.body.classList.remove('noscroll');
            }
        };

        window.addEventListener('resize', checkDesktopResize);
    }
    
    // --- Lógica de Expansão/Colapso de Subcategorias (Acordeão) ---
    const categoriaButtons = document.querySelectorAll('.categoria-button:not(.todos-produtos a)');
    
    categoriaButtons.forEach(button => {
        // Inicializa ou garante o ícone de toggle
        let iconSpan = button.querySelector('.expand-icon');
        if (!iconSpan) {
            iconSpan = document.createElement('span');
            iconSpan.classList.add('expand-icon');
            iconSpan.style.marginLeft = 'auto';
            iconSpan.style.fontWeight = '900';
            iconSpan.style.fontSize = '1.3rem';
            button.appendChild(iconSpan);
        }
        iconSpan.textContent = '+'; 

        button.addEventListener('click', () => {
            const expanded = button.getAttribute('aria-expanded') === 'true';
            
            // Fechar todas as outras categorias
            categoriaButtons.forEach(btn => {
                const sublist = document.getElementById(btn.getAttribute('aria-controls'));
                if (btn !== button && btn.getAttribute('aria-expanded') === 'true') {
                    btn.setAttribute('aria-expanded', 'false');
                    btn.querySelector('.expand-icon').textContent = '+';
                    if (sublist) {
                        sublist.classList.remove('expanded');
                        setTimeout(() => sublist.hidden = true, 350);
                    }
                }
            });

            // Abrir/Fechar a categoria clicada
            if (!expanded) {
                button.setAttribute('aria-expanded', 'true');
                iconSpan.textContent = '−';
                const sublist = document.getElementById(button.getAttribute('aria-controls'));
                if (sublist) {
                    sublist.hidden = false;
                    setTimeout(() => sublist.classList.add('expanded'), 10);
                }
            } else {
                button.setAttribute('aria-expanded', 'false');
                iconSpan.textContent = '+';
                const sublist = document.getElementById(button.getAttribute('aria-controls'));
                if (sublist) {
                    sublist.classList.remove('expanded');
                    setTimeout(() => sublist.hidden = true, 350);
                }
            }
        });
    });

    // --- Lógica do Autocomplete (MANTIDA) ---
    const input = document.getElementById('search-input');
    const autocompleteList = document.getElementById('autocomplete-list');
    let activeIndex = -1;

    if (input) {
        
        input.addEventListener('input', () => {
            const query = input.value.trim();
            if (query.length < 2) {
                autocompleteList.innerHTML = '';
                autocompleteList.hidden = true;
                input.setAttribute('aria-expanded', 'false');
                return;
            }

            // A lógica de fetch para produto_autocomplete.php deve estar funcionando
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
                });
        });

        // Navegação com teclado no autocomplete (ArrowDown/Up, Enter, Escape)
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
                    } else {
                        input.closest('form').submit(); // Envia o formulário se nada estiver selecionado
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

        // Fecha sugestões clicando fora (melhorado para não fechar o sidebar)
        document.addEventListener('click', (e) => {
             const isClickOnSidebar = sidebar.contains(e.target) || menuToggleBtn.contains(e.target);

             if (!input.contains(e.target) && !autocompleteList.contains(e.target)) {
                autocompleteList.innerHTML = '';
                autocompleteList.hidden = true;
                input.setAttribute('aria-expanded', 'false');
            }
        });
    }
});