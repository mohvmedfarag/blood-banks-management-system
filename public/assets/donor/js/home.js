let icon =document.getElementById('icon');
let snav =document.getElementById('snav');
icon.onclick=function(){
    snav.classList.toggle("nav");
}

const background = document.getElementById('background');
const images = [
  'url("photo/pto 1.png")',
  'url("photo/pto 2.png")',
  'url("photo/pto 3.png")'
];
let currentIndex = 0;

function changeBackground() {
    currentIndex = (currentIndex + 1) % images.length;
    background.style.backgroundImage = images[currentIndex];
}

setInterval(changeBackground, 3000);


