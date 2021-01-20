const searchForm = document.querySelector('.search');
const searchInput = searchForm.querySelector('input');
const searchButton = searchForm.querySelector('.search-button');
const profileContainer = document.querySelector(".profiles-panel");
const fromInput = document.querySelector('#from');
const toInput = document.querySelector('#to');


function search() {
    const languageOpt = document.querySelector('#language');
    const countryOpt = document.querySelector('#country');
    const cityOpt = document.querySelector('#city');
    const data = {
        searchInput: searchInput.value,
        country: countryOpt.value,
        city: cityOpt.value
    };

    if(languageOpt.value !== languageOpt.id){
        data.language = languageOpt.value;
    }
    else{
        data.language = "";
    }

    fetch("/search", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then(function (profiles) {
        profileContainer.innerHTML = "";
        if(profiles == null){
            return;
        }
        loadProfiles(profiles);
        checkFollowers();
    })
}

function loadProfiles(profiles) {
    profiles.forEach(profile => {
        createProfile(profile);
    });
}

function createProfile(profile) {
    const template = document.querySelector("#profile-template");

    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = profile.id_user;
    const image = clone.querySelector("img");
    image.src = `/public/uploads/${profile.image}`;
    const name = clone.querySelector("h2");
    name.innerHTML = profile.name + " " + profile.surname;
    const details = clone.querySelector("p");
    details.innerHTML = profile.country + " " + profile.city + " " + profile.language;
    const profButton = clone.querySelector(".user-button");
    profButton.value = profile.email;
    profButton.addEventListener('click', function (){
        linkToProfile(profButton.value);
    });
    const followButton = clone.querySelector('.follow-button');
    (profile.is_friend === null) ? followButton.value = 0 : followButton.value = 1;
    followButton.addEventListener('click', function (){
        followAction(followButton);
    });
    profileContainer.appendChild(clone);
}

searchButton.addEventListener('click', function() {
    search();
});

searchInput.addEventListener('keyup', function (event) {
   if(event.key === "Enter") {
       event.preventDefault();
       search();
   }
});

fromInput.addEventListener('click', function (){
    this.type = 'date';
});

toInput.addEventListener('click', function (){
    this.type = 'date';
});

fromInput.addEventListener('blur', function (){
    this.type = 'text';
});

toInput.addEventListener('blur', function (){
    this.type = 'text';
});