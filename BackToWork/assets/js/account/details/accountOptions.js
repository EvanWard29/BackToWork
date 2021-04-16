$(function(){
    $('#redeem').click(function(){

    });

    $('#btnSaveEmail').click(async function(){
        let emailErr = false;
        let passwordErr = false;

        let currentEmail = $('#currentEmail').val();
        let newEmail = $('#inpChangeEmail').val();
        let password = CryptoJS.AES.encrypt($('#inpConfirmPassword').val(), "CHEESEBURGER");

        $('#invChangeEmailExists').attr('hidden', true);
        if(newEmail === ""){
            //Email is blank
            emailErr = true;

            $('#inpChangeEmail').addClass('is-invalid');
            $('#invChangeEmail').attr('hidden', false);
        }else{
            //Email is NOT blank - Check if contains @
            if(validateEmail(newEmail) === false){
                //Email does NOT contain @
                emailErr = true;

                $('#inpChangeEmail').addClass('is-invalid');
                $('#invChangeEmail').attr('hidden', false);
            }else{
                //Email does contain @
                if(newEmail.length > 45){
                    //Email too long
                    emailErr = true;

                    $('#inpChangeEmail').addClass('is-invalid');
                    $('#invChangeEmail').attr('hidden', false);
                }else{
                    emailErr = true;

                    $('#inpChangeEmail').removeClass('is-invalid');
                    $('#invChangeEmail').attr('hidden', true);

                    if(newEmail === currentEmail){
                        //Email is same
                        emailErr = true;

                        $('#inpChangeEmail').addClass('is-invalid');
                        $('#invChangeEmailSame').attr('hidden', false);
                    }else{
                        emailErr = true;

                        $('#inpChangeEmail').removeClass('is-invalid');
                        $('#invChangeEmailSame').attr('hidden', true);
                        //Email is different - Check If Already Exists
                        await $.post("/BackToWork/src/controller/account/registration/checkEmail.php",{
                            email: newEmail
                        }, function(response){
                            if(response !== ""){
                                //Email exists
                                emailErr = true;

                                $('#inpChangeEmail').addClass('is-invalid');
                                $('#invChangeEmailExists').attr('hidden', false);
                            }else{
                                //Email doesn't exist
                                emailErr = false;

                                $('#inpChangeEmail').removeClass('is-invalid');
                                $('#invChangeEmailExists').attr('hidden', true);
                            }
                        });
                    }
                }
            }
        }

        if(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
            //Password is blank
            passwordErr = true;

            $('#invConfirmPassword').attr('hidden', false);
            $('#inpConfirmPassword').addClass('is-invalid');
        }else{
            //Password is not blank - Check password is correct
            await $.post("/BackToWork/src/controller/account/login/loginUser.php", {
                inpLgnEmail: currentEmail
            }, function (data) {
                data = JSON.parse(data)[0];
                try {
                    if (CryptoJS.AES.decrypt(data.password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8).localeCompare(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8)) !== 0) {
                        //Passwords do NOT match
                        $('#invConfirmPassword').attr('hidden', false);
                        $('#inpConfirmPassword').addClass('is-invalid');

                        passwordErr = true;
                    } else {
                        //Passwords match
                        $('#invConfirmPassword').attr('hidden', true);
                        $('#inpConfirmPassword').removeClass('is-invalid');

                        passwordErr = false;
                    }
                }catch(err){
                    $('#invConfirmPassword').attr('hidden', false);
                    $('#inpConfirmPassword').addClass('is-invalid');

                    passwordErr = true;
                }
            });
        }

        if(emailErr !== true && passwordErr !== true){
            //Process Change
            $.post("/BackToWork/src/controller/account/details/changeEmail.php",{
                currentEmail: currentEmail,
                newEmail: newEmail
            }, function(response){
                alert("Email Changed!\nRedirecting To Login");
                document.cookie = "userID=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                document.cookie = "groupID=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                document.cookie = "accountType=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";

                location.replace("/BackToWork/public/account/login/login.php");
            });
        }
    });

    $('#btnSavePassword').click(async function(){
        let emailErr = false;
        let passwordErr = false;

        let email = $('#inpConfirmEmail').val();
        let oldPassword = CryptoJS.AES.encrypt($('#inpOldPassword').val(), "CHEESEBURGER");
        let newPassword = CryptoJS.AES.encrypt($('#inpChangePassword').val(), "CHEESEBURGER");
        let confirm = CryptoJS.AES.encrypt($('#inpConfirmPasswordChange').val(), "CHEESEBURGER");;

        if(email === ""){
            //Email is blank
            emailErr = true;

            $('#inpConfirmEmail').addClass('is-invalid');
            $('#invConfirmEmail').attr('hidden', false);
        }else{
            //Email is not blank
            if(validateEmail(email) === false) {
                //Email does NOT contain @
                emailErr = true;

                $('#inpConfirmEmail').addClass('is-invalid');
                $('#invConfirmEmail').attr('hidden', false);
            }else{
                //Email does contain @
                emailErr = false;

                $('#inpConfirmEmail').removeClass('is-invalid');
                $('#invConfirmEmail').attr('hidden', true);
            }
        }

        if(CryptoJS.AES.decrypt(oldPassword, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
            //Blank
            passwordErr = true;

            $('#invConfirmOld').attr('hidden', false);
            $('#inpOldPassword').addClass('is-invalid');
        }else{
            passwordErr = false;

            $('#invConfirmOld').attr('hidden', true);
            $('#inpOldPassword').removeClass('is-invalid');
        }

        if(CryptoJS.AES.decrypt(newPassword, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
            //Password is blank
            passwordErr = true;

            $('#invChangePassword').attr('hidden', false);
            $('#inpChangePassword').addClass('is-invalid');
        }else{
            //Password is not blank
            passwordErr = false;

            $('#invChangePassword').attr('hidden', true);
            $('#inpChangePassword').removeClass('is-invalid');
        }

        if(CryptoJS.AES.decrypt(confirm, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
            //Confirm Password is blank
            passwordErr = true;

            $('#invChangePassword').attr('hidden', false);
            $('#inpConfirmPasswordChange').addClass('is-invalid');
        }else{
            //Confirm password is NOT blank
            passwordErr = false;

            $('#inpConfirmPasswordChange').removeClass('is-invalid');
            $('#invChangePassword').attr('hidden', true);
        }

        if(passwordErr !== true){
            //Check if too short
            if(CryptoJS.AES.decrypt(newPassword, "CHEESEBURGER").toString(CryptoJS.enc.Utf8).length <= 5){
                passwordErr = true;

                $('#invChangePassword').attr('hidden', false);
                $('#inpChangePassword').addClass('is-invalid');
                $('#inpConfirmPasswordChange').addClass('is-invalid');
            }else{
                passwordErr = false;

                $('#invChangePassword').attr('hidden', true);
                $('#inpChangePassword').removeClass('is-invalid');
                $('#inpConfirmPasswordChange').removeClass('is-invalid');
            }
        }

        if(passwordErr !== true) {
            if (CryptoJS.AES.decrypt(newPassword, "CHEESEBURGER").toString(CryptoJS.enc.Utf8).localeCompare(CryptoJS.AES.decrypt(confirm, "CHEESEBURGER").toString(CryptoJS.enc.Utf8)) !== 0) {
                passwordErr = true;

                $('#invChangePassword').attr('hidden', false);
                $('#inpChangePassword').addClass('is-invalid');
                $('#inpConfirmPasswordChange').addClass('is-invalid');
            }else {
                //Passwords Match - Check Correct
                await $.post("/BackToWork/src/controller/account/login/loginUser.php", {
                    inpLgnEmail: email
                }, function (data) {
                    data = JSON.parse(data)[0];
                    try {
                        if (CryptoJS.AES.decrypt(data.password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8).localeCompare(CryptoJS.AES.decrypt(oldPassword, "CHEESEBURGER").toString(CryptoJS.enc.Utf8)) !== 0) {
                            //Passwords do NOT match
                            $('#invLogin').attr('hidden', false);
                            $('#inpConfirmEmail').addClass('is-invalid');
                            $('#inpOldPassword').addClass('is-invalid');

                            passwordErr = true;
                        } else {
                            //Passwords match
                            $('#invLogin').attr('hidden', true);
                            $('#inpConfirmEmail').removeClass('is-invalid');
                            $('#inpOldPassword').removeClass('is-invalid');

                            passwordErr = false;
                        }
                    }catch(err){
                        $('#invLogin').attr('hidden', false);
                        $('#inpConfirmEmail').addClass('is-invalid');
                        $('#inpOldPassword').addClass('is-invalid');

                        passwordErr = true;
                    }
                });
            }
        }

        if(emailErr !== true && passwordErr !== true){
            //Correct Details - Save Password
            $.post("/BackToWork/src/controller/account/details/changePassword.php",{
                email: email,
                password: newPassword.toString()
            }, function(response){
                alert("Password Changed Successfully!\nRedirecting To Login");
                document.cookie = "userID=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                document.cookie = "familyID=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
                document.cookie = "accountType=; expires=Thu, 01 Jan 1970 00:00:00 UTC;";

                location.replace("/BackToWork/public/account/login/login.php");
            });
        }
    });

    $('#modalChangeEmail').on('hide.bs.modal', function(){
       $('#inpChangeEmail').val("").removeClass('is-invalid');
       $('#invChangeEmail').attr('hidden', true);
    });

    $('#modalChangePassword').on('hide.bs.modal', function(){
       $('#inpConfirmEmail').val("").removeClass('is-invalid');
       $('#inpOldPassword').val("").removeClass('is-invalid');
       $('#inpChangePassword').val("").removeClass('is-invalid');
       $('#inpConfirmPasswordChange').val("").removeClass('is-invalid');

       $('#invLogin').attr('hidden', true);
       $('#invConfirmEmail').attr('hidden', true);
       $('#invConfirmOld').attr('hidden', true);
       $('#invChangePassword').attr('hidden', true);
    });
});

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}