window.onload = function (){
    const path = window.location.pathname;
    const page = path.split("/")[1];

    if(page === "myProfile" || page === "editProfile" || page === "profile"){
        checkUserRole();
    }
    if(page === "home" || page === "profile"){
        checkFollowers();
    }
    checkSiteProperties();
}