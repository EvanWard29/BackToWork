$(function(){
    /** Registration **/
    $('#btnRegister').click(async function(){
        let dobErr = false;
        let firstErr = false;
        let lastErr = false;
        let groupErr = false;
        let emailErr = false;
        let passwordErr = false;
        let typeErr = false;

        let firstName = $('#inpFirstName').val();
        let lastName = $('#inpLastName').val();
        let groupName = $('#inpGroupName').val();
        let DOB = new Date($('#inpDOB').val());
        let email = $('#inpEmail').val();
        let type = $('#inpType').val();

        let password = CryptoJS.AES.encrypt($('#inpPassword').val(), "CHEESEBURGER");
        let confirm = CryptoJS.AES.encrypt($('#inpConfirmPassword').val(), "CHEESEBURGER");

        if(DOB < new Date()){
            $('#invDOB').attr('hidden', true);
        }else{
            //Invalid Date
            $('#invDOB').attr('hidden', false);
            dobErr = true;
        }

        if(dobErr !== true && location.pathname === "/BackToWork/public/account/registration/registration.php"){
            if(_calculateAge(DOB) < 14){
                //User too young to register
                dobErr = true;
                $('#youngDOB').attr('hidden', false);
            }else{
                //Age is 14 or older
                $('#youngDOB').attr('hidden', true);
                dobErr = false;
            }
        }

        //Perform validation techniques on user inputs
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

        //If current page is registration page
        if(location.pathname !== "/BackToWork/public/group/myGroup.php"){
            if(groupName === ""){
                //Group Name empty
                $('#invGroupName').attr('hidden', false);
                $('#inpGroupName').addClass('is-invalid');

                groupErr = true;
            }else{
                //Group Name not empty
                if(groupName.length > 45){
                    //Group name too long
                    $('#invGroupName').attr('hidden', false);
                    $('#inpGroupName').addClass('is-invalid');

                    groupErr = true;
                }else{
                    $('#invGroupName').attr('hidden', true);
                    $('#inpGroupName').removeClass('is-invalid');

                    groupErr = false;
                }
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
                    //Check if Email already exists in DB
                    await $.post("/BackToWork/src/controller/account/registration/checkEmail.php",{
                        email: email
                    }, function(response){
                        if(response !== ""){
                            //Email exists
                            emailErr = true;
                            $('#invEmailExists').attr('hidden', false);
                            $('#inpEmail').addClass('is-invalid');
                        }else{
                            //Email doesn't exist
                            emailErr = false;
                            $('#invEmailExists').attr('hidden', true);
                            $('#inpEmail').removeClass('is-invalid');
                        }
                    });
                }
            }
        }

        if(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
            //Password Field Empty
            $('#inpPassword').addClass("is-invalid");
            $('#invPassword').attr('hidden', false);
            $('#inpConfirmPassword').addClass('is-invalid');

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

        //If all checks pass - save new user in DB
        if(firstErr !== true && lastErr !== true && groupErr !== true && dobErr !== true && emailErr !== true && passwordErr !== true && typeErr !== true){
            let groupID = getCookie('groupID');

            if(groupID === ""){
                //If current page is registration page / adding new user to new group
                groupID = 0;
            }else{
                //If current page is My Group page / adding new user to existing group
                groupName = 'null';
            }

            //Send data to server and redirect to login or reload
            password = password.toString();
            $.post("/BackToWork/src/controller/account/registration/newMember.php", {
                firstName: firstName,
                lastName: lastName,
                groupName: groupName,
                type: type,
                dob: $('#inpDOB').val(),
                email: email,
                password: password,
                groupID: groupID
            },function(response){
                $('#modalNewMember').modal('hide');
                $('#inpFirstName').val("");
                $('#inpLastName').val("");
                $('#inpGroupName').val("");
                $('#inpDOB').val("");
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

    $('#inpDOB').on('change', function(){
        if(_calculateAge(new Date($('#inpDOB').val())) < 14){
            //User too young to be admin
            $('#inpType').attr('disabled', true).get(0).selectedIndex = 2;
        }else{
            //Age is 14 or older
            $('#inpType').attr('disabled', false).get(0).selectedIndex = 0;
        }
    })

    //Tidy modal when closed
    $('#modalNewMember').on('hide.bs.modal', function(){
        $('#inpFirstName').val('');
        $('#inpLastName').val('');
        $('#inpDOB').val('');
        $('#inpEmail').val('');
        $('#inpPassword').val('');
        $('#inpConfirmPassword').val('');
        $('#invType').attr('hidden', true);
        $('#invDOB').attr('hidden', true);
        $('#inpType').attr('disabled', false).get(0).selectedIndex = 0;
    });
});

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function _calculateAge(birthday) { // birthday is a date
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}