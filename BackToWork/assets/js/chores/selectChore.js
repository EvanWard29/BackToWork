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

    /** Select Chore **/
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

    //Switch to Edit Chore mode
    $('#btnEditChore').click(function(){
        $('#editChoreName').attr('readonly', false);
        $('#editChoreDescription').attr('readonly', false);
        $('#editChorePoints').attr('readonly', false);

        $('#btnEditChore').hide();
        $('#btnSaveChore').attr('hidden', false);

        $('#lblAssignTo').attr('hidden', true);
        $('#assignChore').val("Select User").attr('hidden', true);

        $('#lblDeadline').attr('hidden', true);
        $('#choreDeadline').attr('hidden', true);

        $('#btnDeleteChore').attr('hidden', false);

        $('#btnAssignChore').attr('hidden', true);
    });

    //Tidy up modals when closed
    $('#btnCloseChore').click(function(){
        $('#assignedChoreName').val("");
        $('#assignedChoreDescription').val("");
        $('#assignedChoreUser').val("");
        $('#assignedChoreStatus').val("");
    });


    $('#modalEditChore').on('hide.bs.modal', function(){
        $('#editChoreName').val("").attr('readonly', true).removeClass('is-invalid');
        $('#editChoreDescription').val("").attr('readonly', true).removeClass('is-invalid');
        $('#editChorePoints').val("").attr('readonly', true).removeClass('is-invalid');

        $('#invEditChoreName').attr('hidden', true);
        $('#invEditChoreDescription').attr('hidden', true);
        $('#invEditChorePoints').attr('hidden', true);

        $('#lblAssignTo').attr('hidden', false);
        $('#assignChore').val("Select User").attr('hidden', false);

        $('#btnSaveChore').attr('hidden', true);
        $('#btnEditChore').css('display', 'block');

        $('#lblDeadline').attr('hidden', false);
        $('#choreDeadline').val(new Date().toString()).attr('hidden', false);

        $('#btnDeleteChore').attr('hidden', true);
        $('#btnAssignChore').attr('hidden', false);
    })
});

//Function for getting the details of the selected Unassigned Chore
function getChoreDetails(choreID){
    for(let i = 0; i < chores.length; i++){
        let id = chores[i].choreID;
        if(choreID === id){
            //Present details of selected chore
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

//Function for getting the details of the selected Assigned Chore
function getAssignedChores(assignedChoreID){
    for(let i = 0; i < assignedChores.length; i++){
        if(assignedChoreID === assignedChores[i].assignedChoreID){
            //Get chore details of selected assigned chore
            for(let j = 0; j < chores.length; j++){
                if(chores[j].choreID === assignedChores[i].choreID){
                    //Present assigned chore details
                    $('#assignedChoreID').html(assignedChoreID);
                    $('#assignedChoreName').val(chores[j].choreName);
                    $('#assignedChoreDescription').val(chores[j].choreDescription);
                    $('#assignedChoreDeadline').val(assignedChores[i].deadline)
                    $('#assignedChoreStatus').val(assignedChores[i].status);

                    getUser(assignedChores[i].userID);

                    break;
                }
            }
            break;
        }
    }
}

//Function for getting the name of the assigned user
function getUser(userID){
    for(let i = 0; i < users.length; i++){
        if(userID === users[i].userID){
            //Present name of assigned user
            $('#assignedChoreUser').val(users[i].userName);
            break;
        }
    }
}