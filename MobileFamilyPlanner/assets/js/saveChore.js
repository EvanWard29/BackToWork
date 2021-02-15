$(function(){
    $('#btnAssignChore').click(function(){
        let user = $('#assignChore').val();
        //let familyID = 1;
        let choreID = $('#editChoreID').html();

        $('#assignChore').val("Select User");

        $.post("/MobileFamilyPlanner/src/controller/assignChore.php",{
            user: user,
            //familyID: familyID,
            choreID: choreID
        },function(){
            location.reload();
        });
    });
});