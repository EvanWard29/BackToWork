$(function(){
    $('#modalEditChore').on('hide.bs.modal', function(){
        $('#editChoreName').val("").attr('readonly', true).removeClass('is-invalid');
        $('#editChoreDescription').val("").attr('readonly', true).removeClass('is-invalid');
        $('#editChorePoints').val("").attr('readonly', true).removeClass('is-invalid');

        $('#invEditChoreName').attr('hidden', true);
        $('#invEditChoreDescription').attr('hidden', true);
        $('#invEditChorePoints').attr('hidden', true);

        $('#assignChore').val("Select User").attr('disabled', false);

        $('#btnSaveChore').attr('hidden', true);
        $('#btnEditChore').css('display', 'block');

        $('#choreDeadline').val(new Date().toString()).attr('disabled', false);

        $('#btnDeleteChore').attr('hidden', true);
    })

    let choreID = null;
   $("td").click(function(){
      let suffix = this.id;
      choreID = suffix.replace(/[^0-9]/g,'');
      let type = suffix.replace(/\d+/g, '')

      if(type === "chore"){
         let choreID = suffix.replace(/[^0-9]/g,'');

         $.post("/BackToWork/src/controller/getChores.php",
             function(data){
                data = $.parseJSON(data);
                for(let i = 0; i < data.length; i++){
                   let id= data[i][0];
                   if(choreID == id){
                      let name = data[i][1];
                      let description = data[i][2];
                      let points = data[i][3];

                      $('#editChoreID').html(choreID);
                      $('#editChoreName').val(name);
                      $('#editChoreDescription').val(description);
                      $('#editChorePoints').val(points);

                      $('#btnEditChore').attr('hidden', false);
                      break;
                   }
                }
             }
         );
      }
      else if(type === "assignedChore"){
         let assignedChoreID = suffix.replace(/[^0-9]/g,'');

         $.post("/BackToWork/src/controller/getChores.php",
             function(data){
                data = $.parseJSON(data);
                getAssignedChores(data, assignedChoreID);
             }
         );
      }

   });

   $('#btnCloseChore').click(function(){
      $('#assignedChoreName').val("");
      $('#assignedChoreDescription').val("");
      $('#assignedChoreUser').val("");
      $('#assignedChoreStatus').val("");
   });

   $('#btnEditChore').click(function(){
       $('#editChoreName').attr('readonly', false);
       $('#editChoreDescription').attr('readonly', false);
       $('#editChorePoints').attr('readonly', false);

       $('#btnEditChore').hide();
       $('#btnSaveChore').attr('hidden', false);

       $('#assignChore').val("Select User").attr('disabled', true);
       $('#choreDeadline').attr('disabled', true);

       $('#btnDeleteChore').attr('hidden', false);
   });

   $('#btnSaveChore').click(function(){
       let nameErr = false;
       let descriptionErr = false;
       let pointsErr = false;

       let choreName = $('#editChoreName').val();
       let choreDescription = $('#editChoreDescription').val();
       let chorePoints = $('#editChorePoints').val();

       if(choreName === ""){
           //Chore Name is blank
           nameErr = true;

           $('#editChoreName').addClass('is-invalid');
           $('#invEditChoreName').attr('hidden', false);
       }else{
           //Chore Name is NOT blank
           nameErr = false;
           $('#editChoreName').removeClass('is-invalid');
           $('#invEditChoreName').attr('hidden', true);
       }

       if(choreDescription === ""){
           //Chore Description is blank
           descriptionErr = true;

           $('#editChoreDescription').addClass('is-invalid');
           $('#invEditChoreDescription').attr('hidden', false);
       }else{
           //Chore Description is NOT blank
           descriptionErr = false;

           $('#editChoreDescription').removeClass('is-invalid');
           $('#invEditChoreDescription').attr('hidden', true);
       }

       if(chorePoints === ""){
           //Chore Points is blank
           pointsErr = true;

           $('#editChorePoints').addClass('is-invalid');
           $('#invEditChorePoints').attr('hidden', false);
       }else{
           //Chore Points is NOT blank

           if(isNaN(chorePoints) === true){
               //Chore Points is NOT a valid number
               pointsErr = true;

               $('#editChorePoints').addClass('is-invalid');
               $('#invEditChorePoints').attr('hidden', false);
           }else{
               pointsErr = false;

               $('#editChorePoints').removeClass('is-invalid');
               $('#invEditChorePoints').attr('hidden', true);
           }
       }


       if(nameErr !== true && descriptionErr !== true && pointsErr !== true) {
           if (choreID != null) {
               $.post("/BackToWork/src/controller/editChore.php",
                   {
                       id: choreID,
                       name: choreName,
                       description: choreDescription,
                       points: chorePoints
                   },
                   function (data, status) {
                        location.reload();
                   }
               );

               $('#btnEditChore').show();
               $('#btnSaveChore').attr('hidden', true);

               $('#editChoreName').attr('readonly', true);
               $('#editChoreDescription').attr('readonly', true);
               $('#assignChore').attr('disabled', false);
           }
       }
   });
});

function getAssignedChores(chores, assignedChoreID){
   $.post("/BackToWork/src/controller/getAssignedChores.php",{familyID: getCookie('familyID')},
       function(data){
          data = $.parseJSON(data);
          let assignedChores = data;

          for(let i = 0; i < assignedChores.length; i++){
             if(assignedChoreID === assignedChores[i][0]){
                for(let j = 0; j < chores.length; j++){
                   if(chores[j][0] === assignedChores[i][2]){
                       $('#assignedChoreID').html(assignedChoreID);
                      $('#assignedChoreName').val(chores[j][1]);
                      $('#assignedChoreDescription').val(chores[j][2]);
                      $('#assignedChoreDeadline').val(assignedChores[i][3])
                      $('#assignedChoreStatus').val(assignedChores[i][4]);

                      getUser(assignedChores[i][1]);
                      break;
                   }
                }
                break;
             }
          }
       }
   );
}

function getUser(userID){
   $.post("/BackToWork/src/controller/getUsers.php",{familyID: getCookie('familyID')},
       function(data){
          data = $.parseJSON(data);
          let users = data;

          for(let i = 0; i < users.length; i++){
             if(userID === users[i][0]){
               $('#assignedChoreUser').val(users[i][1]);

                 if($('#assignedChoreStatus').val() !== "COMPLETE"){
                     $('#btnComplete').attr('hidden', false);
                 }else{
                     $('#btnComplete').attr('hidden', true);
                 }
                break;
             }
          }
       }
   );
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}