function ajustarAlturaHeader() {
    const header = document.querySelector('header');
    const primeiraSecao = document.getElementById('apresentacao');
    
    if (header && primeiraSecao) {
        const alturaHeader = header.offsetHeight; 
        primeiraSecao.style.scrollMarginTop = `${alturaHeader + 20}px`; 
        document.body.style.paddingTop = `${alturaHeader}px`;
    }
}

window.addEventListener('load', ajustarAlturaHeader);
window.addEventListener('resize', ajustarAlturaHeader);

function configurarAnimacaoEntrada() {
    const elementosAnimados = document.querySelectorAll('.animacao-entrada');
    
    const opcoesObserver = {
        root: null,
        rootMargin: '0px 0px -10% 0px',
        threshold: 0.01 
    };

    const observador = new IntersectionObserver((entradas) => {
        entradas.forEach(entrada => {
            if (entrada.isIntersecting) {
                entrada.target.classList.add('visivel');
            }
        });
    }, opcoesObserver);

    elementosAnimados.forEach(secao => {
        observador.observe(secao);
    });
}

document.addEventListener('DOMContentLoaded', configurarAnimacaoEntrada);

function configurarParallax() {
    const imagem = document.querySelector('.imagem-principal');
    if (!imagem) return;

    const FORCA_PARALLAX = 0.1; 
    const secao = imagem.closest('section');
    if (!secao) return;

    const secaoTopo = secao.offsetTop;

    window.addEventListener('scroll', () => {
        const posicaoScroll = window.scrollY;
        const deslocamento = (posicaoScroll - secaoTopo); 
        imagem.style.transform = `translateY(${deslocamento * FORCA_PARALLAX * -1}px)`;
    });
}

window.addEventListener('load', configurarParallax);

document.querySelectorAll('a[href^="#"]').forEach(ancora => {
    ancora.addEventListener('click', function (e) {
        e.preventDefault(); 

        const idAlvo = this.getAttribute('href');
        const elementoAlvo = document.querySelector(idAlvo);

        if (elementoAlvo) {
            elementoAlvo.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
console.log(window.screen.width);

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
