const hamburgerButton = document.querySelector('#hamburger');
const mgButton = document.querySelector('#mg');

window.onload = function (){
    checkSiteProperties();
};

hamburgerButton.addEventListener('click', function (){
    document.querySelector("ul").classList.toggle('show-menu');

});

mgButton.addEventListener('click', function (){
    document.querySelector(".search-panel").classList.toggle('show-search');
});

function checkSiteProperties(){
    const path = window.location.pathname;
    if(path.split("/").pop() !== "home"){
        mgButton.classList.add('disappear');
    }
    else if(mgButton.classList.contains('disappear')){
        mgButton.classList.remove('disappear')
    }
}