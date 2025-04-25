const track = document.querySelector('.carousel-track');
const leftBtn = document.querySelector('.carousel-btn.left');
const rightBtn = document.querySelector('.carousel-btn.right');

let scrollAmount = 0;
const scrollStep = 180;

rightBtn.addEventListener('click', () => {
  scrollAmount += scrollStep;
  track.scrollTo({ left: scrollAmount, behavior: 'smooth' });
});

leftBtn.addEventListener('click', () => {
  scrollAmount -= scrollStep;
  if (scrollAmount < 0) scrollAmount = 0;
  track.scrollTo({ left: scrollAmount, behavior: 'smooth' });
});

let isDown = false;
let startX;
let scrollLeft;

track.addEventListener('mousedown', (e) => {
  isDown = true;
  startX = e.pageX - track.offsetLeft;
  scrollLeft = track.scrollLeft;
});

track.addEventListener('mouseleave', () => { isDown = false; });
track.addEventListener('mouseup', () => { isDown = false; });
track.addEventListener('mousemove', (e) => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - track.offsetLeft;
  const walk = (x - startX) * 2;
  track.scrollLeft = scrollLeft - walk;
});

track.addEventListener('touchstart', (e) => {
  startX = e.touches[0].pageX;
  scrollLeft = track.scrollLeft;
});

track.addEventListener('touchmove', (e) => {
  const x = e.touches[0].pageX;
  const walk = (x - startX) * 2;
  track.scrollLeft = scrollLeft - walk;
});
