const deleteButtons = document.querySelectorAll('.delete-button');

function checkUserRole(){
    const role = document.cookie.split(';')[1].substr(length-1);
    if(role == 2){
        deleteButtons.forEach(button=> {
            button.classList.add('delete-button-active');
        });
    }
}

deleteButtons.forEach(button=> button.addEventListener('click', function(){
    const container = button.parentElement.parentElement;
    const id = container.getAttribute("id");
    fetch(`/deleteReview/${id}`)
        .then(function (){
            window.location.reload(true);
        });
}));