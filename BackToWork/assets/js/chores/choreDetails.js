let chores = null;
let users = null;
let assignedChores = null;
let choreID = null;

$(function(){
    //Get group's chores from server
    $.post("/BackToWork/src/controller/chores/getChores.php",{
            groupID: getCookie('groupID')
        }, function(data){
            data = $.parseJSON(data);
            chores = data;
        }
    );

    //Get group's Users from server
    $.post("/BackToWork/src/controller/chores/getUsers.php",{
            groupID: getCookie('groupID')
        }, function(data){
            data = $.parseJSON(data);
            users = data;
        }
    );

    //Get group's Assigned Chores from server
    $.post("/BackToWork/src/controller/chores/getAssignedChores.php",{
            groupID: getCookie('groupID')
        }, function(data){
            data = $.parseJSON(data);
            assignedChores = data;
        }
    );

    //Tidy modal when closed
    $('#modalEditChore').on('hide.bs.modal', function(){
        $('#editChoreName').val("").attr('readonly', true).removeClass('is-invalid');
        $('#editChoreDescription').val("").attr('readonly', true).removeClass('is-invalid');
        $('#editChorePoints').val("").attr('readonly', true).removeClass('is-invalid');

        $('#invEditChoreName').attr('hidden', true);
        $('#invEditChoreDescription').attr('hidden', true);
        $('#invEditChorePoints').attr('hidden', true);

        $('#assignChore').val("Select User").attr('disabled', false);

        $('#btnSaveChore').attr('hidden', true);
        $('#btnEditChore').css('display', 'block');

        $('#choreDeadline').val(new Date().toString()).attr('disabled', false);

        $('#btnDeleteChore').attr('hidden', true);
    })

    //User has selected an assigned or unassigned chore to view the details of
    $("td").click(function(){
        //Get ID and type of selected item
        let suffix = this.id;
        choreID = suffix.replace(/[^0-9]/g,'');
        let type = suffix.replace(/\d+/g, '')

        //If item selected is an unassigned chore
        if(type === "chore"){
            let choreID = suffix.replace(/[^0-9]/g,'');
            getChoreDetails(choreID);
        } //Else if selected item is an assigned chore
        else if(type === "assignedChore"){
            let assignedChoreID = suffix.replace(/[^0-9]/g,'');
            getAssignedChores(assignedChoreID);
        }

    });

    //Tidy up modal when closed
    $('#btnCloseChore').click(function(){
        $('#assignedChoreName').val("");
        $('#assignedChoreDescription').val("");
        $('#assignedChoreUser').val("");
        $('#assignedChoreStatus').val("");
    });

    //Switch to Edit Chore mode
    $('#btnEditChore').click(function(){
        $('#editChoreName').attr('readonly', false);
        $('#editChoreDescription').attr('readonly', false);
        $('#editChorePoints').attr('readonly', false);

        $('#btnEditChore').hide();
        $('#btnSaveChore').attr('hidden', false);

        $('#assignChore').val("Select User").attr('disabled', true);
        $('#choreDeadline').attr('disabled', true);

        $('#btnDeleteChore').attr('hidden', false);
    });
});

function getChoreDetails(choreID){
    //Go through the group's chore and present the details of selected chore
    for(let i = 0; i < chores.length; i++){
        let id = chores[i].choreID;
        if(choreID === id){
            let name = chores[i].choreName;
            let description = chores[i].choreDescription;
            let points = chores[i].chorePoints;

            $('#editChoreID').html(choreID);
            $('#editChoreName').val(name);
            $('#editChoreDescription').val(description);
            $('#editChorePoints').val(points);

            $('#btnEditChore').attr('hidden', false);
            break;
        }
    }
}

function getAssignedChores(assignedChoreID){
    //Go through the group's assigned chores and present selected assigned chore's details
    for(let i = 0; i < assignedChores.length; i++){
        if(assignedChoreID === assignedChores[i].assignedChoreID){
            for(let j = 0; j < chores.length; j++){
                if(chores[j].choreID === assignedChores[i].choreID){
                    $('#assignedChoreID').html(assignedChoreID);
                    $('#assignedChoreName').val(chores[j].choreName);
                    $('#assignedChoreDescription').val(chores[j].choreDescription);
                    $('#assignedChoreDeadline').val(assignedChores[i].deadline)
                    $('#assignedChoreStatus').val(assignedChores[i].status);

                    //Function to get the name of the assigned user
                    getUser(assignedChores[i].userID);
                    break;
                }
            }
            break;
        }
    }
}

function getUser(userID){
    //Go through group's users and present assigned user's name
    for(let i = 0; i < users.length; i++){
        if(userID === users[i].userID){
            $('#assignedChoreUser').val(users[i].userName);

            if($('#assignedChoreStatus').val() !== "COMPLETE"){
                $('#btnComplete').attr('hidden', false);
            }else{
                $('#btnComplete').attr('hidden', true);
            }
            break;
        }
    }
}