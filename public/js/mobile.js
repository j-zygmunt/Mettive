const hamburgerButton = document.querySelector('#hamburger');
const mgButton = document.querySelector('#mg');

hamburgerButton.addEventListener('click', function (){
    document.querySelector("ul").classList.toggle('show-menu');
});

mgButton.addEventListener('click', function (){
    document.querySelector(".search-panel").classList.toggle('show-search');
});