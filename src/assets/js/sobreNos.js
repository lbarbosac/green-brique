
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

indicators.forEach(indicator => {
  indicator.addEventListener('click', () => {
    index = parseInt(indicator.dataset.index);
    updateCarousel();
  });
});

setInterval(() => {
  index = (index + 1) % slides.length;
  updateCarousel();
}, 5000);

// Inicializa mostrando o primeiro slide
updateCarousel();
