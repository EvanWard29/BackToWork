$(function(){
    let page = window.location.pathname;
    if(page !== "/BackToWork/public/account/login/login.php" && page !== "/BackToWork/public/account/registration/registration.php") {
        let userID = getCookie('userID');
        if (userID === "") {
            location.replace('/BackToWork/public/account/login/login.php');
        }
    }
});