$(function(){
    let choreID = null;
    /** Delete Chore **/
    $('#btnDeleteChore').click(function(){
        choreID = $('#editChoreID').html();

        $('#modalEditChore').modal('hide');
        $('#modalConfirmChoreDelete').modal('show');
    });

    $('#btnCancelChoreDelete').click(function(){
        $('#modalConfirmChoreDelete').modal('hide');
    });

    $('#btnConfirmChoreDelete').click(function(){
        //Remove selected chore from DB
        $.post("/BackToWork/src/controller/chores/deleteChore.php", {
            choreID: choreID,
            groupID: getCookie('groupID')
        }, function(data){
            location.reload();
        });
    });
});