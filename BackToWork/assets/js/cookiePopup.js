$(function () {
    /** Accept Cookies **/
    $("#cookieBoxOk").click(function () {
        let expire = new Date();

        //Create a new cookie that lasts a month to prevent popup showing again
        expire.setTime(expire.getTime() + (30 * 24 * 60 * 60 * 1000));
        document.cookie = "seenCookie=yes; expires=" + expire.toGMTString() + "; path=/";

        $('#cookieBarBox').addClass('cookie-fade');
    });

    let cookieValue = getCookie('seenCookie');

    if (cookieValue != null && cookieValue === 'yes') {
        //Popup seen
        $('#cookieBarBox').addClass('hidden');
    }
});