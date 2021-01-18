const searchForm = document.querySelector('.search');
const searchInput = searchForm.querySelector('input');
const searchButton = searchForm.querySelector('button');
const profileContainer = document.querySelector(".profiles-panel");

function search() {
    const data = {searchInput: searchInput.value};

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
        loadProfiles(profiles)
    })
}

function loadProfiles(profiles) {
    profiles.forEach(profile => {
        console.log(profile);
        createProfile(profile);
    })
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
    linkToProfile(profButton);

    profileContainer.appendChild(clone);
}


searchButton.addEventListener('click', function() {
    search();
});

searchInput.addEventListener('keyup', function (event) {
   if(event.key === "Enter")
   {
       event.preventDefault();
       search();
   }
});
