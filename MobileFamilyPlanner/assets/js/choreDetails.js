$(function(){
    let choreID = null;
   $("td").click(function(){
      let suffix = this.id;
      choreID = suffix.replace(/[^0-9]/g,'');
      let type = suffix.replace(/\d+/g, '')

      if(type == "chore"){
         let choreID = suffix.replace(/[^0-9]/g,'');

         $.post("/MobileFamilyPlanner/src/controller/getChores.php",
             function(data){
                data = $.parseJSON(data);
                for(let i = 0; i < data.length; i++){
                   let id= data[i][0];
                   if(choreID == id){
                      let name = data[i][1];
                      let description = data[i][2];
                      $('#editChoreID').html(choreID);
                      $('#editChoreName').val(name);
                      $('#editChoreDescription').val(description);
                      break;
                   }
                }
             }
         );
      }
      else if(type == "assignedChore"){
         let assignedChoreID = suffix.replace(/[^0-9]/g,'');

         $.post("/MobileFamilyPlanner/src/controller/getChores.php",
             function(data){
                data = $.parseJSON(data);
                getAssignedChores(data, assignedChoreID);
             }
         );
      }
      else{
         console.log("ERROR");
      }

   });

   $('#btnCloseChore').click(function(){
      $('#editChoreName').val("").attr('readonly', true);
      $('#editChoreDescription').val("").attr('readonly', true);
      $('#assignChore').val("Select User");
      $('#assignChore').attr('disabled', false);

      $('#assignedChoreName').val("");
      $('#assignedChoreDescription').val("");
      $('#assignedChoreUser').val("");
      $('#assignedChoreStatus').val("");
   });

   $('#btnEditChore').click(function(){
       $('#editChoreName').attr('readonly', false);
       $('#editChoreDescription').attr('readonly', false);
       $('#btnEditChore').hide();
       $('#btnSaveChore').attr('hidden', false);
       $('#assignChore').val("Select User");
       $('#assignChore').attr('disabled', true)
   });

   $('#btnSaveChore').click(function(){
       let choreName = $('#editChoreName').val();
       let choreDescription = $('#editChoreDescription').val();

       if(choreID != null){
           $.post("/MobileFamilyPlanner/src/controller/editChore.php",
               {
                   id: choreID,
                   name: choreName,
                   description: choreDescription
               },
               function(data, status){

               }
           );
           
           $('#btnEditChore').show();
           $('#btnSaveChore').attr('hidden', true);

           $('#editChoreName').attr('readonly', true);
           $('#editChoreDescription').attr('readonly', true);
           $('#assignChore').attr('disabled', false);
       }
   });
});

function getAssignedChores(chores, assignedChoreID){
   $.post("/MobileFamilyPlanner/src/controller/getAssignedChores.php",
       function(data){
          data = $.parseJSON(data);
          let assignedChores = data;

          for(let i = 0; i < assignedChores.length; i++){
             if(assignedChoreID == assignedChores[i][0]){
                for(let j = 0; j < chores.length; j++){
                   if(chores[j][0] == assignedChores[i][2]){
                      $('#assignedChoreName').val(chores[j][1]);
                      $('#assignedChoreDescription').val(chores[j][2]);
                      $('#assignedChoreStatus').val(assignedChores[i][3]);

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
   $.post("/MobileFamilyPlanner/src/controller/getUsers.php",
       function(data){
          data = $.parseJSON(data);
          let users = data;

          for(let i = 0; i < users.length; i++){
             if(userID == users[i][0]){
               $('#assignedChoreUser').val(users[i][1]);
                break;
             }
          }
       }
   );
}