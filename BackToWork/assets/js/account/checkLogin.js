$(function(){
    //Function for checking if a user is logged in.
    //If user has not logged in, redirect to login page.
    let page = window.location.pathname;
    if(page !== "/BackToWork/public/account/login/login.php" && page !== "/BackToWork/public/account/registration/registration.php") {
        let userID = getCookie('userID');
        //If user not logged in, redirect to login
        if (userID === "") {
            location.replace('/BackToWork/public/account/login/login.php');
        }
    }
});