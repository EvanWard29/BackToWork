$(function(){
   $('#btnNewMember').click(function(){
       $('#modalNewMember').modal('show');
   });

   $('#btnCloseNewMember').click(function(){
       $('#inpFirstName').removeClass("is-invalid");
       $('#invFirstName').attr('hidden', true);

       $('#inpLastName').removeClass("is-invalid");
       $('#invLastName').attr('hidden', true);

       $('#inpEmail').removeClass("is-invalid");
       $('#invEmail').attr('hidden', true);

       $('#inpPassword').removeClass("is-invalid");
       $('#invPassword').attr('hidden', true);

       $('#inpConfirmPassword').removeClass("is-invalid");
       $('#invConfirmPassword').attr('hidden', true);
   });

   /*$('#btnSaveMember').click(async function(){
       let firstErr = false;
       let lastErr = false;
       let emailErr = false;
       let passwordErr = false;

      let firstName = $('#inpFirstName').val();
      let lastName = $('#inpLastName').val();
      let email = $('#inpEmail').val();

      let password = CryptoJS.AES.encrypt($('#inpPassword').val(), "CHEESEBURGER");
      //let decrypt = CryptoJS.AES.decrypt(password, "Secret Passphrase");
      //console.log(decrypt.toString(CryptoJS.enc.Utf8));
      let confirm = CryptoJS.AES.encrypt($('#inpConfirmPassword').val(), "CHEESEBURGER");

      if(firstName === ""){
          //First Name Field Empty
          $('#inpFirstName').addClass("is-invalid");
          $('#invFirstName').attr('hidden', false);

          firstErr = true;
      }else{
          $('#inpFirstName').removeClass("is-invalid");
          $('#invFirstName').attr('hidden', true);

          firstErr = false;
      }

      if(lastName === ""){
          //Last Name Field Empty
          $('#inpLastName').addClass("is-invalid");
          $('#invLastName').attr('hidden', false);

          lastErr = true;
      }else{
          $('#inpLastName').removeClass("is-invalid");
          $('#invLastName').attr('hidden', true);

          lastErr = false;
      }

      if(email === ""){
          //Email Field Empty
          $('#inpEmail').addClass("is-invalid");
          $('#invEmail').attr('hidden', false);
      }else{
          $('#inpEmail').removeClass("is-invalid");
          $('#invEmail').attr('hidden', true);

          emailErr = false;

          if(validateEmail(email) === false){
              //Email Doesn't contain @
              $('#inpEmail').addClass("is-invalid");
              $('#invEmail').attr('hidden', false);

              emailErr = true;
          }else{
              emailErr = false;
          }
      }

      if(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
          //Password Field Empty
          $('#inpPassword').addClass("is-invalid");
          $('#invPassword').attr('hidden', false);

          passwordErr = true;
      }else{
          $('#inpPassword').removeClass("is-invalid");
          $('#invPassword').attr('hidden', true);

          passwordErr = false;
      }

      if(CryptoJS.AES.decrypt(confirm, "CHEESEBURGER").toString(CryptoJS.enc.Utf8) === ""){
          //Confirm Password Field Empty
          $('#inpConfirmPassword').addClass("is-invalid");
          $('#invConfirmPassword').attr('hidden', false);

          passwordErr = true;
      }else{
          $('#inpConfirmPassword').removeClass("is-invalid");
          $('#invConfirmPassword').attr('hidden', true);

          passwordErr = false;

          if(CryptoJS.AES.decrypt(password, "CHEESEBURGER").toString(CryptoJS.enc.Utf8).localeCompare(CryptoJS.AES.decrypt(confirm, "CHEESEBURGER").toString(CryptoJS.enc.Utf8)) !== 0){
              //Passwords do not Match
              $('#inpPassword').addClass("is-invalid");
              $('#invPassword').attr('hidden', false);

              $('#inpConfirmPassword').addClass("is-invalid");
              $('#invConfirmPassword').attr('hidden', false);
              passwordErr = true;
          }else{
              passwordErr = false;
          }
      }

      if(firstErr !== true && lastErr !== true && emailErr !== true && passwordErr !== true){
          //Validation Complete
          password = password.toString();
          $.post("/BackToWork/src/controller/newMember.php", {
              firstName: firstName,
              lastName: lastName,
              email: email,
              password: password
          },function(response){
                $('#inpFirstName').val("");
                $('#inpLastName').val("");
                $('#inpEmail').val("");
                $('#inpPassword').val("");
                $('#inpConfirmPassword').val("");
          })
      }
   });*/

   $('tr').click(function(){
       $('#modalViewMember').modal('show');

       $('#memberID').html($(this).find(".names").attr('id').replace( /^\D+/g, ''));
       $('#inpName').val($(this).find(".names").html());
       $('#inpChoresCompleted').val($(this).find(".choresCompleted").html());
       $('#inpPoints').val($(this).find(".points").html().replace(/ /g,''));
   })

    $('#btnEditMember').click(function(){
       $('#inpName').attr('readonly', false);
       $('#inpChoresCompleted').attr('readonly', false);
       $('#inpPoints').attr('readonly', false);

       $('#btnEditMember').attr('hidden', true);
       $('#btnSave').attr('hidden', false);
    });

   $('#btnSave').click(function(){
      //Do Processing
       let nameErr = false;
       let choresCompletedErr = false;
       let pointsErr = false;

       let name = $('#inpName').val();
       let choresCompleted = $('#inpChoresCompleted').val();
       let points = $('#inpPoints').val();

       if(name === ""){
           //Name is blank
           $('#invName').attr('hidden', false);
           $('#inpName').addClass('is-invalid');

           nameErr = true;
       }else{
           //Name is NOT blank
           $('#invName').attr('hidden', true);
           $('#inpName').removeClass('is-invalid');

           nameErr = false;
       }

       if(choresCompleted === ""){
           //Chores Completed is blank
           $('#invChoresCompleted').attr('hidden', false);
           $('#inpChoresCompleted').addClass('is-invalid');

           choresCompletedErr = true;
       }else{
           //Chores Completed is NOT blank
           $('#invChoresCompleted').attr('hidden', true);
           $('#inpChoresCompleted').removeClass('is-invalid');

           choresCompletedErr = false;

           if(isNaN(choresCompleted) === true){
               //Chores Completed is NOT a number
               $('#invChoresCompleted').attr('hidden', false);
               $('#inpChoresCompleted').addClass('is-invalid');

               choresCompletedErr = true;
           }else{
               //Chores Completed is a number
               $('#invChoresCompleted').attr('hidden', true);
               $('#inpChoresCompleted').removeClass('is-invalid');

               choresCompletedErr = false;
           }
       }

       if(points === ""){
           //Points is blank
           $('#invPoints').attr('hidden', false);
           $('#inpPoints').addClass('is-invalid');

           pointsErr = true;
       }else{
           //Points is NOT blank
           $('#invPoints').attr('hidden', true);
           $('#inpPoints').removeClass('is-invalid');

           pointsErr = false;

           if(isNaN(points) ===true){
               //Points is NOT a number
               $('#invPoints').attr('hidden', false);
               $('#inpPoints').addClass('is-invalid');

               pointsErr = true;
           }else{
               //Points is a number
               $('#invPoints').attr('hidden', true);
               $('#inpPoints').removeClass('is-invalid');

               pointsErr = false;
           }
       }

       if((nameErr !== true) && (choresCompletedErr !== true) && (pointsErr !== true)){
           //Update Details
           let userID = $('#memberID').html();

           $.post("/BackToWork/src/controller/updateMember.php",{
               userID: userID,
               firstName: name,
               choresCompleted: choresCompleted,
               points: points
           }, function(){
               location.reload();
           })
       }
   });

   $('#btnCloseMember').click(function(){
       $('#inpName').attr('readonly', true);
       $('#inpChoresCompleted').attr('readonly', true);
       $('#inpPoints').attr('readonly', true);

       $('#btnSave').attr('hidden', true);
       $('#btnEditMember').attr('hidden', false);
   });
});

/*function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}*/