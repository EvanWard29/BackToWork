$(function(){
   $('#btnDeleteChore').click(function(){
       let choreID = $('#editChoreID').html();

       $.post("/BackToWork/src/controller/chores/deleteChore.php", {
           choreID: choreID,
           groupID: getCookie('groupID')
       }, function(data){
            location.reload();
       });
   });
});