const rateButton = document.querySelector('.rate-button');
const nav = document.querySelector('nav');
const reviewPanel = document.querySelector('.ratings-panel');
const aboutPanel = document.querySelector('.about-panel');
const reviewWindow = document.querySelector('.add-review');
const addButton = document.querySelector('.add');
const cancelButton = document.querySelector('.cancel');
const mailButton = document.querySelector('.message-button');


function addReview() {
    const data = {
        message: document.querySelector('textarea').value,
        rating: document.querySelector('#rate').value,
        idReviewee: document.querySelector('.about-panel').getAttribute("id")
    };

    fetch("/addReview", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (){
        removeBlur();
    });
}

function removeBlur(){
    nav.classList.remove('blur');
    reviewPanel.classList.remove('blur');
    aboutPanel.classList.remove('blur');
    reviewWindow.classList.remove('window-review-open');
}

function addBlur(){
    nav.classList.add('blur');
    reviewPanel.classList.add('blur');
    aboutPanel.classList.add('blur');
    reviewWindow.classList.add('window-review-open');
}


rateButton.addEventListener('click', function (){
    addBlur();
});

addButton.addEventListener('click', function (){
    addReview();
    window.location.reload(true);
});

cancelButton.addEventListener('click', function (){
    removeBlur();
});

mailButton.addEventListener('click', function (){
    window.open('mailto:' + mailButton.value);
});