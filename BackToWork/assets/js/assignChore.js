$(function(){
    $('#modalAssignedChore').on('hide.bs.modal', function(){
        $('#btnReassign').attr('hidden', false);
        $('#assignedChoreUser').attr('hidden', false);
        $('#lblAssignedUser').attr('hidden', false);

        $('#lblAssignNewUser').attr('hidden', true);
        $('#btnSaveReassign').attr('hidden', true);

        $('#assignUser').val("Select User").attr('hidden', true);
    });

    $('#assignChore').on('change', function(){
       if($('#assignChore').val() !== "Select User"){
           $('#btnAssignChore').attr('disabled', false);
       }else{
           $('#btnAssignChore').attr('disabled', true);
       }
    });

    $('#btnAssignChore').click(function(){
        let user = $('#assignChore').val();
        let familyID = getCookie('familyID');
        let choreID = $('#editChoreID').html();
        let deadline = $('#choreDeadline').val();

        if(deadline === ""){
            //Deadline not selected
            $('#invDeadline').attr('hidden', false);
        }else{
            $('#invDeadline').attr('hidden', true);

            $.post("/BackToWork/src/controller/assignChore.php",{
                user: user,
                familyID: familyID,
                choreID: choreID,
                deadline: deadline.replace('T', ' ')
            },function(response){
                location.reload();
            });
        }
    });

    $('#btnReassign').click(function(){
        $('#btnReassign').attr('hidden', true);
        $('#assignedChoreUser').attr('hidden', true);
        $('#lblAssignedUser').attr('hidden', true);

        $('#lblAssignNewUser').attr('hidden', false);
        $('#assignUser').attr('hidden', false);
        $('#btnSaveReassign').attr('hidden', false);
    });

    $('#btnSaveReassign').click(function(){
       let newUser = $('#assignUser').val();
       let familyID = getCookie('familyID');
       let assignedChoreID = $('#assignedChoreID').html();

       $.post("/BackToWork/src/controller/reassignChore.php", {
           user: newUser,
           familyID: familyID,
           assignedChoreID: assignedChoreID
        }, function(response){
            location.reload();
       });
    });

    $('#assignUser').on('change', function(){
        if($('#assignUser').val() !== "Select User") {
            $('#btnSaveReassign').attr('disabled', false);
        }else{
            $('#btnSaveReassign').attr('disabled', true);
        }
    })
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