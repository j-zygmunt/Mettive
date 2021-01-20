const followButton = document.querySelectorAll('.follow-button');
const userButtons = document.querySelectorAll('.user-button');


function linkToProfile(val) {
    location.href = `/profile/${val}`;
}

function followAction(button) {
    const container = button.parentElement.parentElement.parentElement;
    const id = container.getAttribute("id");
    if(button.classList.contains('unfollow')){
        fetch(`/unfollow/${id}`)
            .then(function (){
                button.classList.remove('unfollow');
            });
    }
    else{
        fetch(`/follow/${id}`)
            .then(function (){
                button.classList.add('unfollow');
            });
    }
}

function checkFollowers(){
    document.querySelectorAll('.follow-button').forEach(button => {
       if(button.value == 1){
           button.classList.add('unfollow');
       }
    });
}


followButton.forEach(button=>button.addEventListener('click', function (){
    followAction(button);
}));

userButtons.forEach(button=> button.addEventListener('click', function (){
    linkToProfile(button.value);
}));