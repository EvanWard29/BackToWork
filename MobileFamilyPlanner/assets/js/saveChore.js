$(function(){
    $('#btnAssignChore').click(function(){
        let user = $('#assignChore').val();
        let familyID = getCookie('familyID');
        let choreID = $('#editChoreID').html();

        $('#assignChore').val("Select User");

        $.post("/MobileFamilyPlanner/src/controller/assignChore.php",{
            user: user,
            familyID: familyID,
            choreID: choreID
        },function(response){
            location.reload();
        });
    });
});

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}