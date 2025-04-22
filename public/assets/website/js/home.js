let icon =document.getElementById('icon');
let snav =document.getElementById('snav');
icon.onclick=function(){
    snav.classList.toggle("nav");
}

let btn = document.getElementById('scroll');

onscroll = function(){
    if(this.scrollY >= 2000){
        btn.style.display = 'block';
        
    }else{
        btn.style.display = 'none';
    }
}
btn.onclick = function(){
    window.scrollTo({
        top:0,
        behavior:'smooth',
    })
}
// const background = document.getElementById('background');
// const images = [
//   'url("photo/pto1.png")',
//   'url("photo/pto2.png")',
//   'url("photo/pto3.png")'
// ];
// let currentIndex = 0;

// function changeBackground() {
//     currentIndex = (currentIndex + 1) % images.length;
//     background.style.backgroundImage = images[currentIndex];
// }

// setInterval(changeBackground, 3000);




