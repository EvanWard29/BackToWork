$(function(){
   $('#btnDeleteChore').click(function(){
       let choreID = $('#editChoreID').html();

       $.post("/MobileFamilyPlanner/src/controller/deleteChore.php", {choreID: choreID}, function(data){
            location.reload();
       });
   });
});