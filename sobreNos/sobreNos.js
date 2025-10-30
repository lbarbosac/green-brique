// seleção de elementos
const carousel = document.querySelector('.carousel');
const cards = Array.from(document.querySelectorAll('.card'));
const nextBtn = document.querySelector('.next');
const prevBtn = document.querySelector('.prev');

// distância que o botão irá mover (aprox. largura de 1 card + gap)
function getStep() {
  const first = cards[0];
  if (!first) return 300;
  const rect = first.getBoundingClientRect();
  return Math.round(rect.width + 20);
}

// desloca com animação
nextBtn.addEventListener('click', () => {
  const step = getStep();
  carousel.scrollBy({ left: step, behavior: 'smooth' });
});
prevBtn.addEventListener('click', () => {
  const step = getStep();
  carousel.scrollBy({ left: -step, behavior: 'smooth' });
});

// atualiza estado e destaque do card central
function updateState() {
  const maxScroll = carousel.scrollWidth - carousel.clientWidth;
  prevBtn.disabled = carousel.scrollLeft <= 4;
  nextBtn.disabled = carousel.scrollLeft >= maxScroll - 4;

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

  cards.forEach(c => c.classList.remove('active'));
  if (closest) closest.classList.add('active');
}

let scrollTimer;
carousel.addEventListener('scroll', () => {
  clearTimeout(scrollTimer);
  scrollTimer = setTimeout(() => updateState(), 80);
});

window.addEventListener('resize', updateState);
window.addEventListener('load', updateState);
