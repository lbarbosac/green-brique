const carousel = document.querySelector('.carousel');
const cards = Array.from(document.querySelectorAll('.card'));
const nextBtn = document.querySelector('.next');
const prevBtn = document.querySelector('.prev');

let currentIndex = 0;
let isAnimating = false;
let autoPlayInterval = null;

function clamp(v, a, b) { return Math.max(a, Math.min(b, v)); }

function getTargetScroll(index) {
  const target = cards[index];
  if (!target) return carousel.scrollLeft;
  return target.offsetLeft - (carousel.clientWidth - target.offsetWidth) / 2;
}

// animação suave via requestAnimationFrame
function animateScroll(target) {
  if (isAnimating) return;
  isAnimating = true;

  const start = carousel.scrollLeft;
  const distance = target - start;
  const duration = 600;
  const startTime = performance.now();

  function step(now) {
    const progress = Math.min((now - startTime) / duration, 1);
    const ease = 0.5 - Math.cos(progress * Math.PI) / 2;
    carousel.scrollLeft = start + distance * ease;

    if (progress < 1) {
      requestAnimationFrame(step);
    } else {
      isAnimating = false;
      updateState();
    }
  }

  requestAnimationFrame(step);
}

function scrollToCard(index) {
  // looping infinito
  if (index >= cards.length) index = 0;
  if (index < 0) index = cards.length - 1;

  const target = getTargetScroll(index);
  animateScroll(target);
  currentIndex = index;
  updateState();
}

function updateState() {
  cards.forEach(c => c.classList.remove('active'));
  if (cards[currentIndex]) cards[currentIndex].classList.add('active');
}

// botões de navegação
nextBtn.addEventListener('click', () => {
  if (isAnimating) return;
  scrollToCard(currentIndex + 1);
});

prevBtn.addEventListener('click', () => {
  if (isAnimating) return;
  scrollToCard(currentIndex - 1);
});

// ===== AUTO PLAY =====
function startAutoPlay() {
  if (autoPlayInterval) clearInterval(autoPlayInterval);
  autoPlayInterval = setInterval(() => {
    if (!isAnimating) scrollToCard(currentIndex + 1);
  }, 3000); // muda a cada 3s (pode ajustar)
}

function stopAutoPlay() {
  clearInterval(autoPlayInterval);
  autoPlayInterval = null;
}

// pausa ao passar o mouse
carousel.addEventListener('mouseenter', stopAutoPlay);
carousel.addEventListener('mouseleave', startAutoPlay);

// inicializa
window.addEventListener('load', () => {
  scrollToCard(0);
  startAutoPlay();
});
