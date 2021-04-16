$(function(){
    $('#btnComplete').click(async function(){
        //Remove from assigned_chore table
        let assignedChoreID = $('#assignedChoreID').html(); //Get assignedChoreID
        let deadline = $('#assignedChoreDeadline').val();

        let currentDate = new Date();

        let formatDeadline = new Date(deadline);

        if(formatDeadline > currentDate){
            let userPoints = getCookie('points');

            $.post("/BackToWork/src/controller/chores/getChoreValue.php", {
                assignedChoreID: assignedChoreID
            }, function(response){
                userPoints = parseInt(userPoints) + parseInt(response);

                document.cookie = "points=" + userPoints + ";path=/";
            });

            //Before Deadline - No Penalty
            $.post("/BackToWork/src/controller/chores/completeChore.php", {
                assignedChoreID: assignedChoreID,
                groupID: getCookie('groupID')
            }, function(response){
                location.reload();
            });
        }else{
            //Past Deadline - Penalty
            $.post("/BackToWork/src/controller/chores/getPenalty.php", {
                assignedChoreID: assignedChoreID
            }, async function(penalty){
                //Get user who was assigned to chore and deduct points
                let userPoints = null;

                await $.post("/BackToWork/src/controller/chores/getUserPoints.php", {
                    assignedChoreID: assignedChoreID
                }, function(points){
                    userPoints = points;
                });

                let newPoints = userPoints - penalty;

                if(newPoints < 0){
                    newPoints = 0;
                }

                //Update DB
                $.post("/BackToWork/src/controller/chores/updatePoints.php",{
                    assignedChoreID: assignedChoreID,
                    points: newPoints
                }, function(response){
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