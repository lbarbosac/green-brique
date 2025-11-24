

const slides = document.querySelectorAll('.carousel-slide');
const indicators = document.querySelectorAll('.indicator');
let index = 0;

function updateCarousel() {
  slides.forEach((slide, i) => {
    slide.style.display = i === index ? 'flex' : 'none';
  });
  indicators.forEach(ind => ind.classList.remove('active'));
  indicators[index].classList.add('active');
}

document.querySelector('.next').addEventListener('click', () => {
  index = (index + 1) % slides.length;
  updateCarousel();
});

document.querySelector('.prev').addEventListener('click', () => {
  index = (index - 1 + slides.length) % slides.length;
  updateCarousel();
});
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

// animação suave via requestAnimationFrame + ease-out mais fluido
function animateScroll(target) {
  if (isAnimating) return;
  isAnimating = true;

  const start = carousel.scrollLeft;
  const distance = target - start;
  const duration = 800; // levemente mais longo = mais suave
  const startTime = performance.now();

  function step(now) {
    const elapsed = now - startTime;
    const progress = Math.min(elapsed / duration, 1);
    const easeOut = 1 - Math.pow(1 - progress, 3); // suavização mais "natural"
    carousel.scrollLeft = start + distance * easeOut;

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

setInterval(() => {
  index = (index + 1) % slides.length;
  updateCarousel();
}, 5000);

// Inicializa mostrando o primeiro slide
updateCarousel();
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

