const rateButton = document.querySelector('.rate-button');
const nav = document.querySelector('nav');
const reviewPanel = document.querySelector('.ratings-panel');
const aboutPanel = document.querySelector('.about-panel');
const reviewWindow = document.querySelector('.add-review');
const addButton = document.querySelector('.add');

function addReview() {
    const data =
        {message: document.querySelector('textarea').value,
            rating: document.querySelector('#rate').value,
            idReviewee: document.querySelector('.about-panel').getAttribute("id")}

    fetch("/addReview", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (){
        nav.classList.remove('blur');
        reviewPanel.classList.remove('blur');
        aboutPanel.classList.remove('blur');
        reviewWindow.classList.remove('window-review-open');
    });
}

rateButton.addEventListener('click', function (){
    nav.classList.add('blur');
    reviewPanel.classList.add('blur');
    aboutPanel.classList.add('blur');
    reviewWindow.classList.add('window-review-open');
});

addButton.addEventListener('click', function (){
    addReview();
    window.location.reload(true);
})