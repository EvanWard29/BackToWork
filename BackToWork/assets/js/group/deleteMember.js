$(function(){
    $('#btnDeleteMember').click(function(){
        $('#deleteName').html($('#inpName').val().trim() + "'s ");

        $('#modalViewMember').modal('hide');
        $('#modalConfirmDelete').modal('show');
    });

    $('#btnConfirmDelete').click(function(){
        let userID = $('#memberID').html();

        $.post("/BackToWork/src/controller/account/details/deleteAccount.php",{
            userID: userID,
            groupID: getCookie('groupID')
        }, function(response){
            location.reload();
        });
    });
});