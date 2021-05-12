$(function(){
    let currentEmail, newEmail, password = null;

    /** Change Email **/
    $('#btnSaveEmail').click(async function(){
        currentEmail = $('#currentEmail').val();
        newEmail = $('#inpChangeEmail').val();
        password = CryptoJS.AES.encrypt($('#inpConfirmPassword').val(), "CHEESEBURGER");

        let emailErr = false;
        let passwordErr = false;

        //Perform validation techniques on user inputs
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
            $('#modalChangeEmail').modal('hide');
            $('#modalConfirmChangeEmail').modal('show');
        }
    });

    $('#btnConfirmEmailChange').click(function(){
        //Save new email to DB and logout
        $.post("/BackToWork/src/controller/account/details/changeEmail.php",{
            currentEmail: currentEmail,
            newEmail: newEmail
        }, function(response){
            location.reload();
        });
    });

    $('#btnCancelChangeEmail').click(function(){
        $('#modalConfirmChangeEmail').modal('hide');
    });

    //Tidy up modal when closed
    $('#modalChangeEmail').on('hide.bs.modal', function(){
       $('#inpChangeEmail').val("").removeClass('is-invalid');
       $('#invChangeEmail').attr('hidden', true);
    });
});

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}