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

   $('tr').click(function(){
       $('#modalViewMember').modal('show');

       $('#memberID').html($(this).find(".names").attr('id').replace( /^\D+/g, ''));
       $('#inpName').val($(this).find(".names").html());
       $('#inpChoresCompleted').val($(this).find(".choresCompleted").html());
       $('#inpPoints').val($(this).find(".points").html().replace(/ /g,''));

       if($('#memberID').html() === getCookie('userID')){
           $('#btnDeleteMember').attr('hidden', true);
       }else{
           $('#btnDeleteMember').attr('hidden', false);
       }
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
           if(name.length > 45){
               //Name is too long
               $('#invName').attr('hidden', false);
               $('#inpName').addClass('is-invalid');

               nameErr = true;
           }else{
               $('#invName').attr('hidden', true);
               $('#inpName').removeClass('is-invalid');

               nameErr = false;
           }
       }

       if(choresCompleted === ""){
           //Chores Completed is blank
           $('#invChoresCompleted').attr('hidden', false);
           $('#inpChoresCompleted').addClass('is-invalid');

           choresCompletedErr = true;
       }else{
           //Chores Completed is NOT blank
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

           $.post("/BackToWork/src/controller/account/details/updateMember.php",{
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