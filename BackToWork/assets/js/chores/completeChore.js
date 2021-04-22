$(function(){
    /** Complete Chore **/
    $('#btnComplete').click(async function(){
        //Get details of assigned chore
        let assignedChoreID = $('#assignedChoreID').html(); //Get assignedChoreID
        let deadline = $('#assignedChoreDeadline').val();

        let currentDate = new Date();
        let formatDeadline = new Date(deadline);

        //Check if chore is past the deadline
        if(formatDeadline > currentDate){
            //Chore completed before deadline - No Penalty
            let userPoints = getCookie('points');

            //Get points value if chore for completing on time
            $.post("/BackToWork/src/controller/chores/getChoreValue.php", {
                assignedChoreID: assignedChoreID
            }, function(response){
                //Update user's points saved in cookie
                userPoints = parseInt(userPoints) + parseInt(response);

                document.cookie = "points=" + userPoints + ";path=/";
            });

            //Update assigned chore to 'COMPLETE' status in DB
            $.post("/BackToWork/src/controller/chores/completeChore.php", {
                assignedChoreID: assignedChoreID,
                groupID: getCookie('groupID')
            }, function(response){
                location.reload();
            });
        }else{
            //Chore completed after deadline - Penalty

            //Get penalty value of chore from DB
            $.post("/BackToWork/src/controller/chores/getPenalty.php", {
                assignedChoreID: assignedChoreID
            }, async function(penalty){
                let userPoints = null;

                //Get user who was assigned to chore and deduct points
                await $.post("/BackToWork/src/controller/chores/getUserPoints.php", {
                    assignedChoreID: assignedChoreID
                }, function(points){
                    userPoints = points;
                });

                let newPoints = userPoints - penalty;

                if(newPoints < 0){
                    newPoints = 0;
                }

                //Update DB with new points
                $.post("/BackToWork/src/controller/chores/updatePoints.php",{
                    assignedChoreID: assignedChoreID,
                    points: newPoints
                }, function(response){
                    //Update status of assigned chore to 'COMPLETE' in DB
                    $.post("/BackToWork/src/controller/chores/incompleteChore.php", {
                        assignedChoreID: assignedChoreID,
                        groupID: getCookie('groupID')
                    }, function(response){
                        location.reload();
                    });
                });
            });
        }
    });
});