const images = document.querySelector('.carousel-images');
const indicators = document.querySelectorAll('.indicator');
let index = 0;

function updateCarousel() {
  images.style.transform = `translateX(${-index * 100}%)`;
  indicators.forEach(ind => ind.classList.remove('active'));
  indicators[index].classList.add('active');
}

document.querySelector('.next').addEventListener('click', () => {
  index = (index + 1) % 4;
  updateCarousel();
});

document.querySelector('.prev').addEventListener('click', () => {
  index = (index - 1 + 4) % 4;
  updateCarousel();
});

indicators.forEach(indicator => {
  indicator.addEventListener('click', () => {
    index = parseInt(indicator.dataset.index);
    updateCarousel();
  });
});

setInterval(() => {
  index = (index + 1) % 4;
  updateCarousel();
}, 5000);
