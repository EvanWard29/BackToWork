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
        let groupID = getCookie('groupID');
        let choreID = $('#editChoreID').html();
        let deadline = $('#choreDeadline').val();

        if(deadline === ""){
            //Deadline not selected
            $('#invDeadline').attr('hidden', false);
        }else{
            $('#invDeadline').attr('hidden', true);

            $.post("/BackToWork/src/controller/chores/assignChore.php",{
                user: user,
                groupID: groupID,
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
       let groupID = getCookie('groupID');
       let assignedChoreID = $('#assignedChoreID').html();

       $.post("/BackToWork/src/controller/chores/reassignChore.php", {
           user: newUser,
           groupID: groupID,
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