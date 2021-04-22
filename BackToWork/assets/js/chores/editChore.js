$(function(){
    /** Edit Chore **/
    $('#btnSaveChore').click(function(){
        let nameErr = false;
        let descriptionErr = false;
        let pointsErr = false;

        //Get edited details of selected chore
        let choreName = $('#editChoreName').val();
        let choreDescription = $('#editChoreDescription').val();
        let chorePoints = $('#editChorePoints').val();

        //Perform validation techniques on User Inputs
        if(choreName === ""){
            //Chore Name is blank
            nameErr = true;

            $('#editChoreName').addClass('is-invalid');
            $('#invEditChoreName').attr('hidden', false);
        }else{
            //Chore Name is NOT blank
            nameErr = false;
            $('#editChoreName').removeClass('is-invalid');
            $('#invEditChoreName').attr('hidden', true);
        }

        if(choreDescription === ""){
            //Chore Description is blank
            descriptionErr = true;

            $('#editChoreDescription').addClass('is-invalid');
            $('#invEditChoreDescription').attr('hidden', false);
        }else{
            //Chore Description is NOT blank
            descriptionErr = false;

            $('#editChoreDescription').removeClass('is-invalid');
            $('#invEditChoreDescription').attr('hidden', true);
        }

        if(chorePoints === ""){
            //Chore Points is blank
            pointsErr = true;

            $('#editChorePoints').addClass('is-invalid');
            $('#invEditChorePoints').attr('hidden', false);
        }else{
            //Chore Points is NOT blank

            if(isNaN(chorePoints) === true){
                //Chore Points is NOT a valid number
                pointsErr = true;

                $('#editChorePoints').addClass('is-invalid');
                $('#invEditChorePoints').attr('hidden', false);
            }else{
                pointsErr = false;

                $('#editChorePoints').removeClass('is-invalid');
                $('#invEditChorePoints').attr('hidden', true);
            }
        }

        //If there are no errors, POST chore details to server to be saved to DB
        if(nameErr !== true && descriptionErr !== true && pointsErr !== true) {
            if (choreID != null) {
                $.post("/BackToWork/src/controller/chores/editChore.php",
                    {
                        id: choreID,
                        name: choreName,
                        description: choreDescription,
                        points: chorePoints,
                        groupID: getCookie('groupID')
                    },
                    function (data, status) {
                        location.reload();
                    }
                );

                $('#btnEditChore').show();
                $('#btnSaveChore').attr('hidden', true);

                $('#editChoreName').attr('readonly', true);
                $('#editChoreDescription').attr('readonly', true);
                $('#assignChore').attr('disabled', false);
            }
        }
    });
});