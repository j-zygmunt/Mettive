const followButton = document.querySelectorAll('.follow-button');
const userButtons = document.querySelectorAll('.user-button');

function linkToProfile(button) {
    button.addEventListener('click', function(){
        location.href = `/profile/${button.value}`;
    })
}

function followAction(button) {

}

function checkFollowers(){

    followButton.forEach(button => {
       if(button.value == 1){
           button.classList.add('unfollow')
       }
    });
}

window.onload = checkFollowers

followButton.forEach(button=>button.addEventListener('click', function (){
    if(button.classList.contains('unfollow')){
        const flag = this
        const container = flag.parentElement.parentElement.parentElement;
        const id = container.getAttribute("id")
        fetch(`/unfollow/${id}`)
            .then(function (){
                button.classList.remove('unfollow')
                console.log('unfollow')
                console.log(button.value)
            });
    }
    else{
        const flag = this
        const container = flag.parentElement.parentElement.parentElement;
        const id = container.getAttribute("id")
        console.log(id)
        fetch(`/follow/${id}`)
            .then(function (){
                button.classList.add('unfollow')
                console.log('follow')
            });
    }
}))


userButtons.forEach(button=> linkToProfile(button))