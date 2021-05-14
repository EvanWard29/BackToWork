$(function(){
    /** Update User **/
    $('#btnSave').click(function(){
        let nameErr = false;
        let choresCompletedErr = false;
        let pointsErr = false;

        //Get edited details of selected user
        let name = $('#inpName').val();
        let choresCompleted = $('#inpChoresCompleted').val();
        let points = $('#inpPoints').val();

        //Perform validation techniques on user inputs
        if(name === ""){
            //Name is blank
            $('#invName').attr('hidden', false);
            $('#inpName').addClass('is-invalid');

            nameErr = true;
        }else{
            //Name is NOT blank
            if(name.length > 45){
                //Name is too long
                $('#invName').attr('hidden', false);
                $('#inpName').addClass('is-invalid');

                nameErr = true;
            }else{
                $('#invName').attr('hidden', true);
                $('#inpName').removeClass('is-invalid');

                nameErr = false;
            }
        }

        if(choresCompleted === ""){
            //Chores Completed is blank
            $('#invChoresCompleted').attr('hidden', false);
            $('#inpChoresCompleted').addClass('is-invalid');

            choresCompletedErr = true;
        }else{
            //Chores Completed is NOT blank
            if(isNaN(choresCompleted) === true){
                //Chores Completed is NOT a number
                $('#invChoresCompleted').attr('hidden', false);
                $('#inpChoresCompleted').addClass('is-invalid');

                choresCompletedErr = true;
            }else{
                //Chores Completed is a number
                $('#invChoresCompleted').attr('hidden', true);
                $('#inpChoresCompleted').removeClass('is-invalid');

                choresCompletedErr = false;
            }
        }

        if(points === ""){
            //Points is blank
            $('#invPoints').attr('hidden', false);
            $('#inpPoints').addClass('is-invalid');

            pointsErr = true;
        }else{
            //Points is NOT blank
            if(isNaN(points) ===true){
                //Points is NOT a number
                $('#invPoints').attr('hidden', false);
                $('#inpPoints').addClass('is-invalid');

                pointsErr = true;
            }else{
                //Points is a number
                $('#invPoints').attr('hidden', true);
                $('#inpPoints').removeClass('is-invalid');

                pointsErr = false;
            }
        }

        //If all checks pass
        if((nameErr !== true) && (choresCompletedErr !== true) && (pointsErr !== true)){
            let userID = $('#memberID').html();

            //Post new details to server for saving to DB
            $.post("/BackToWork/src/controller/account/details/updateMember.php",{
                userID: userID,
                firstName: name.trim(),
                choresCompleted: choresCompleted,
                points: points
            }, function(){
                document.cookie = "points=" + points + ";path=/";
                location.reload();
            })
        }
    });
});