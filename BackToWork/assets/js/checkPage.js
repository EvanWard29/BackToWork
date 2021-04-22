let page = window.location.pathname;

//Disable Navbar if current page is either login or registration
if(page === "/BackToWork/public/account/login/login.php" || page === "/BackToWork/public/account/registration/registration.php") {
    //If user is already logged in - redirect to main page
    if(getCookie('userID') !== ""){
        location.replace("/BackToWork/public/group/myGroup.php");
    }else{
        $('#header').attr('hidden', true);
        $('#linkMain').addClass("linkDisabled");
    }
}