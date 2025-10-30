// seleção de elementos
const carousel = document.querySelector('.carousel');
const cards = Array.from(document.querySelectorAll('.card'));
const nextBtn = document.querySelector('.next');
const prevBtn = document.querySelector('.prev');

// distância que o botão irá mover (aprox. largura de 1 card + gap)
// vamos calcular dinamicamente com base no primeiro card
function getStep() {
  const first = cards[0];
  if (!first) return 300;
  const rect = first.getBoundingClientRect();
  // gap entre cards = 20 conforme CSS
  return Math.round(rect.width + 20);
}

// DESLOCA COM ANIMAÇÃO
nextBtn.addEventListener('click', () => {
  const step = getStep();
  carousel.scrollBy({ left: step, behavior: 'smooth' });
});
prevBtn.addEventListener('click', () => {
  const step = getStep();
  carousel.scrollBy({ left: -step, behavior: 'smooth' });
});

// atualiza o botão disabled e destaque do card central
function updateState() {
  // desabilita botões quando reach ao final/início
  const maxScroll = carousel.scrollWidth - carousel.clientWidth;
  prevBtn.disabled = carousel.scrollLeft <= 4; // tolerância
  nextBtn.disabled = carousel.scrollLeft >= maxScroll - 4;

  // encontra o card cujo centro está mais próximo do centro do viewport do carousel
  const carouselRect = carousel.getBoundingClientRect();
  const carouselCenterX = carouselRect.left + carouselRect.width / 2;

  let closest = null;
  let minDist = Infinity;
  cards.forEach(card => {
    const r = card.getBoundingClientRect();
    const cardCenterX = r.left + r.width / 2;
    const dist = Math.abs(carouselCenterX - cardCenterX);
    if (dist < minDist) {
      minDist = dist;
      closest = card;
    }
  });

  // aplica classe .active ao mais próximo e remove dos outros
  cards.forEach(c => c.classList.remove('active'));
  if (closest) closest.classList.add('active');
}

// atualiza ao rolar (scroll) e ao redimensionar
let scrollTimer;
carousel.addEventListener('scroll', () => {
  // otimização: debounce para não chamar updateState em excesso
  clearTimeout(scrollTimer);
  scrollTimer = setTimeout(() => {
    updateState();
  }, 80);
});

// ao redimensionar recomputar
window.addEventListener('resize', () => {
  updateState();
});

// inicializa o estado ao carregar
window.addEventListener('load', () => {
  // forçar pequena correção caso esteja num scroll residual
  updateState();
  // opcional: centralizar o primeiro card (ou deixar do jeito que está)
  // carousel.scrollLeft = 0;
});
