$(function(){
   var choreName = null;

   $("td").click(function(){
      let choreName = $(this).html().trim();
      $('#editChoreName').val(choreName);

      $.post("/MobileFamilyPlanner/src/controller/getChoreDescription.php", {
         name: choreName },
         function(data){
            $('#editChoreDescription').val(data);
         }
      );
   });

   $('#btnAssignChore').click(function(){
      let user = $('#assignChore').val();
      let familyID = 1;
      let choreID = null;

      $('#assignChore').val("Select User");

      $.post("/MobileFamilyPlanner/src/controller/assignChore.php",{
         user: user,
         family: familyID,
         choreID: choreID
      });
   });
});

function getChoreID(){


   $.post("/MobileFamilyPlanner/src/controller/assignChore.php",{
      name: choreName
   },
   function(data){
      return data;
   });
}