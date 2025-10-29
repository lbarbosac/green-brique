const carousel = document.getElementById('carousel');
const nextBtn = document.getElementById('nextBtn');
const prevBtn = document.getElementById('prevBtn');

let scrollAmount = 0;

nextBtn.addEventListener('click', () => {
  const cardWidth = carousel.querySelector('.team-card').offsetWidth + 20;
  carousel.scrollBy({ left: cardWidth, behavior: 'smooth' });
});

prevBtn.addEventListener('click', () => {
  const cardWidth = carousel.querySelector('.team-card').offsetWidth + 20;
  carousel.scrollBy({ left: -cardWidth, behavior: 'smooth' });
});
