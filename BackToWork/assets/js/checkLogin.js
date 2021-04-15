$(function(){
    let page = window.location.pathname;
    if(page !== "/BackToWork/public/login/login.php" && page !== "/BackToWork/public/registration/registration.php") {
        let userID = getCookie('userID');
        if (userID === "") {
            location.replace('/BackToWork/public/login/login.php');
        }
    }
});