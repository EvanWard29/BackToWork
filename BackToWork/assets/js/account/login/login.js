$(function(){
   $('#btnLogin').click(async function(){
       let emailErr = false;
       let passwordErr = false;

       let email = $('#inpLgnEmail').val();
       let password = CryptoJS.AES.encrypt($('#inpLgnPassword').val(), "CHEESEBURGER");

       //Perform validation techniques on user inputs
       if(email === ""){
           //Email is Blank
           emailErr = true;
           $('#inpLgnEmail').addClass('is-invalid');
           $('#invLgnEmail').attr('hidden', false);
       }else{
           //Email is NOT blank
           if(validateEmail(email) === false){
               //Email does NOT contain '@'
               $('#inpLgnEmail').addClass('is-invalid');
               $('#invLgnEmail').attr('hidden', false);
               emailErr = true;
           }else{
               //Email contains an '@'
               $('#inpLgnEmail').removeClass('is-invalid');
               $('#invLgnEmail').attr('hidden', true);

               emailErr = false;
           }
       }

       //Check passwords match stored password in DB
       if(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
           //Email is blank
           passwordErr = true;
           $('#inpLgnPassword').addClass('is-invalid');
           $('#invLgnPassword').attr("hidden", false);
       }else{
           //Email is NOT blank
           if(emailErr !== true) {
               //Check Password's Match
               await $.post("/BackToWork/src/controller/account/login/loginUser.php", {
                   inpLgnEmail: email
               }, function (data) {
                   data = JSON.parse(data)[0];
                   try {
                       if (CryptoJS.AES.decrypt(data.password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8).localeCompare(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8)) !== 0) {
                           //Passwords do NOT match
                           $('#invLogin').attr('hidden', false);
                           $('#inpLgnEmail').addClass('is-invalid');
                           $('#inpLgnPassword').addClass('is-invalid');

                           passwordErr = true;
                       } else {
                           //Passwords match
                           $('#invLogin').attr('hidden', true);
                           $('#inpLgnEmail').removeClass('is-invalid');
                           $('#inpLgnPassword').removeClass('is-invalid');

                           passwordErr = false;
                       }
                   }catch(err){
                       $('#invLogin').attr('hidden', false);
                       $('#inpLgnEmail').addClass('is-invalid');
                       $('#inpLgnPassword').addClass('is-invalid');

                       passwordErr = true;
                   }
               });
           }
       }

       if(emailErr !== true && passwordErr !== true){
           //Correct Details - Get User Details
           $.post("/BackToWork/src/controller/account/login/loginUser.php",{
               inpLgnEmail: email
           }, function(data){
               data = JSON.parse(data)[0];
               if(getCookie('userID') !== data.userID) {
                   //If no cookies for current user saved
                   if ($('#lgnRemember').prop('checked') === true) {
                       //User checked remember me - save extended period cookie (2 weeks)
                       let today = new Date();
                       let expire = new Date();
                       expire.setTime(today.getTime() + 3600000 * 24 * 14);
                       document.cookie = "userID=" + data.userID + "; path=/; expires=" + expire.toUTCString();
                       document.cookie = "groupID=" + data.groupID + "; path=/; expires=" + expire.toUTCString();
                       document.cookie = "accountType=" + data.type + "; path=/; expires=" + expire.toUTCString();
                       document.cookie = "points=" + data.points + "; path=/; expires=" + expire.toUTCString();

                       location.replace('/BackToWork/public/group/myGroup.php');
                   } else {
                       //User has NOT checked remember me - cookie will be destroyed when session closed
                       document.cookie = "userID=" + data.userID + ";path=/";
                       document.cookie = "groupID=" + data.groupID + ";path=/";
                       document.cookie = "accountType=" + data.type + ";path=/";
                       document.cookie = "points=" + data.points + ";path=/";

                       location.replace('/BackToWork/public/group/myGroup.php');
                   }
               }else{
                   //Log user in
                   location.replace('/BackToWork/public/group/myGroup.php');
               }
           });
       }
   }) ;
});

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}