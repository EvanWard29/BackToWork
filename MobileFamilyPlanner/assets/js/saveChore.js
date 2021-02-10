$(function(){
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