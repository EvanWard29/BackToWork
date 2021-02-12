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

   $('#btnSaveMember').click(function(){
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
      }
   });
});

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}