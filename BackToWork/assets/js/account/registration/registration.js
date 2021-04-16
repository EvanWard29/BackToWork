$(function(){
    $('#btnRegister').click(async function(){
        let firstErr = false;
        let lastErr = false;
        let emailErr = false;
        let passwordErr = false;
        let typeErr = false;

        let firstName = $('#inpFirstName').val();
        let lastName = $('#inpLastName').val();
        let email = $('#inpEmail').val();

        let password = CryptoJS.AES.encrypt($('#inpPassword').val(), "CHEESEBURGER");
        //let decrypt = CryptoJS.AES.decrypt(password, "Secret Passphrase");
        //console.log(decrypt.toString(CryptoJS.enc.Utf8));
        let confirm = CryptoJS.AES.encrypt($('#inpConfirmPassword').val(), "CHEESEBURGER");

        let type = $('#inpType').val();

        if(firstName === ""){
            //First Name Field Empty
            $('#inpFirstName').addClass("is-invalid");
            $('#invFirstName').attr('hidden', false);

            firstErr = true;
        }else{
            //First Name Field Not Empty
            if(firstName.length > 45){
                //First Name too long
                $('#inpFirstName').addClass("is-invalid");
                $('#invFirstName').attr('hidden', false);

                firstErr = true;
            }else{
                $('#inpFirstName').removeClass("is-invalid");
                $('#invFirstName').attr('hidden', true);

                firstErr = false;
            }
        }

        if(lastName === ""){
            //Last Name Field Empty
            $('#inpLastName').addClass("is-invalid");
            $('#invLastName').attr('hidden', false);

            lastErr = true;
        }else{
            //Last name not empty
            if(lastName.length > 45){
                //Last name too long
                $('#inpLastName').addClass("is-invalid");
                $('#invLastName').attr('hidden', false);

                lastErr = true;
            }else{
                $('#inpLastName').removeClass("is-invalid");
                $('#invLastName').attr('hidden', true);

                lastErr = false;
            }
        }

        if(email === ""){
            //Email Field Empty
            $('#inpEmail').addClass("is-invalid");
            $('#invEmail').attr('hidden', false);
            emailErr = true;
        }else{
            if(email.length > 45){
                //Email too long
                $('#inpEmail').addClass("is-invalid");
                $('#invEmail').attr('hidden', false);
                emailErr = true;
            }else{
                //Email right length
                $('#inpEmail').removeClass("is-invalid");
                $('#invEmail').attr('hidden', true);
                emailErr = false;
                if(validateEmail(email) === false){
                    //Email Doesn't contain @
                    $('#inpEmail').addClass("is-invalid");
                    $('#invEmail').attr('hidden', false);

                    emailErr = true;
                }else{
                    //Check if Email already exists
                    await $.post("/BackToWork/src/controller/account/registration/checkEmail.php",{
                        email: email
                    }, function(response){
                        if(response !== ""){
                            //Email exists
                            emailErr = true;
                            $('#invEmailExists').attr('hidden', false);
                        }else{
                            //Email doesn't exist
                            emailErr = false;
                            $('#invEmailExists').attr('hidden', true);
                        }
                    });
                }
            }
        }

        if(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
            //Password Field Empty
            $('#inpPassword').addClass("is-invalid");
            $('#invPassword').attr('hidden', false);

            passwordErr = true;
        }else{
            //Password not empty
            if(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8).length <= 5){
                //Password too short
                $('#inpPassword').addClass("is-invalid");
                $('#inpConfirmPassword').addClass("is-invalid");
                $('#invPassword').attr('hidden', false);

                passwordErr = true;
            }else{
                $('#inpPassword').removeClass("is-invalid");
                $('#inpConfirmPassword').removeClass('is-invalid');
                $('#invPassword').attr('hidden', true);

                passwordErr = false;
            }
        }

        if(passwordErr !== true){
            if(CryptoJS.AES.decrypt(confirm, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
                //Confirm Password Field Empty
                $('#inpConfirmPassword').addClass("is-invalid");
                $('#invConfirmPassword').attr('hidden', false);

                passwordErr = true;
            }else{
                //Confirm password is not empty
                if(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8).localeCompare(CryptoJS.AES.decrypt(confirm, "CHEESEBURGER").toString(CryptoJS.enc.Utf8)) !== 0){
                    //Passwords do not Match
                    $('#inpPassword').addClass("is-invalid");
                    $('#invPassword').attr('hidden', false);

                    $('#inpConfirmPassword').addClass("is-invalid");
                    $('#invConfirmPassword').attr('hidden', false);
                    passwordErr = true;
                }else{
                    $('#inpConfirmPassword').removeClass("is-invalid");
                    $('#invConfirmPassword').attr('hidden', true);
                    passwordErr = false;
                }
            }
        }

        if(type === "Select Account Type"){
            //User hasn't selected account type
            $('#invType').attr('hidden', false);
            typeErr = true;
        }else{
            //User has selected account type
            $('#invType').attr('hidden', true);
            typeErr = false;
        }

        if(firstErr !== true && lastErr !== true && emailErr !== true && passwordErr !== true && typeErr !== true){
            let groupID = getCookie('groupID');

            if(groupID === ""){
                groupID = 0;
            }

            //Validation Complete
            password = password.toString();
            $.post("/BackToWork/src/controller/account/registration/newMember.php", {
                firstName: firstName,
                lastName: lastName,
                type: type,
                email: email,
                password: password,
                groupID: groupID
            },function(response){
                $('#modalNewMember').modal('hide');
                $('#inpFirstName').val("");
                $('#inpLastName').val("");
                $('#inpEmail').val("");
                $('#inpPassword').val("");
                $('#inpConfirmPassword').val("");
                $('#inpType').val('Adult');

                if(window.location.pathname === "/BackToWork/public/group/myGroup.php"){
                    location.reload();
                }else{
                    location.replace("/BackToWork/public/account/login/login.php");
                }
            })
        }
    });
});

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}