$(function(){
    //Open & Close Modal When Buttons Clicked
    $('#btnDeleteGroup').click(function(){
        $('#modalDisbandGroup').modal('show');
    });

    $('#btnCancelDeleteGroup').click(function(){
        $('#modalDisbandGroup').modal('hide');
    });

    //Modal Confirm Disband
    $('#btnDisbandGroup').click(function(){
        $('#modalDisbandGroup').modal('hide');
        $('#modalConfirmDisband').modal('show');
    });

    /** Disband Group **/
    $('#btnConfirmDisband').click(function(){
        //Delete all data relating to group and redirect to login
        $.post("/BackToWork/src/controller/account/disbandGroup.php",{
            groupID: getCookie('groupID')
        }, function(response){
            //Clear Cookies
            document.cookie = "userID=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
            document.cookie = "groupID=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
            document.cookie = "accountType=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
            document.cookie = "points=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC";

            location.replace("/BackToWork/public/account/login/login.php");
        });
    });
});