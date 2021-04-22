$(function(){
    /** Change Password **/
    $('#btnSavePassword').click(async function(){
        let emailErr = false;
        let passwordErr = false;

        let email = $('#inpConfirmEmail').val();
        let oldPassword = CryptoJS.AES.encrypt($('#inpOldPassword').val(), "CHEESEBURGER");
        let newPassword = CryptoJS.AES.encrypt($('#inpChangePassword').val(), "CHEESEBURGER");
        let confirm = CryptoJS.AES.encrypt($('#inpConfirmPasswordChange').val(), "CHEESEBURGER");;

        //Perform validation techniques on user inputs
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
                location.reload();
            });
        }
    });

    //Tidy up modal when closed
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