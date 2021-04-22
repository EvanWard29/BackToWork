$(function(){
    //Show confirmation before removing user
    $('#btnDeleteMember').click(function(){
        $('#deleteName').html($('#inpName').val().trim() + "'s ");

        $('#modalViewMember').modal('hide');
        $('#modalConfirmDelete').modal('show');
    });

    /** Delete Member **/
    $('#btnConfirmDelete').click(function(){
        let userID = $('#memberID').html();

        //Delete user from DB when user clicks confirm
        $.post("/BackToWork/src/controller/account/details/deleteAccount.php",{
            userID: userID,
            groupID: getCookie('groupID')
        }, function(response){
            location.reload();
        });
    });
});