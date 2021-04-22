$(function(){
    /** Delete Chore **/
    $('#btnDeleteChore').click(function(){
        let choreID = $('#editChoreID').html();

        //Remove selected chore from DB
        $.post("/BackToWork/src/controller/chores/deleteChore.php", {
            choreID: choreID,
            groupID: getCookie('groupID')
        }, function(data){
            location.reload();
        });
    });
});