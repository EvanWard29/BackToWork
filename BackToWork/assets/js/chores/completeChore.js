$(function(){
    $('#btnComplete').click(function(){
        //Remove from assigned_chore table
        let assignedChoreID = $('#assignedChoreID').html(); //Get assignedChoreID
        let deadline = $('#assignedChoreDeadline').val();

        let date = deadline.split(' ')[0];
        let time = deadline.split(' ')[1];

        let currentDate = new Date();

        let formatDeadline = new Date(deadline);

        if(formatDeadline > currentDate){
            //Before Deadline - No Penalty
            $.post("/BackToWork/src/controller/chores/completeChore.php", {
                assignedChoreID: assignedChoreID
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
                        assignedChoreID: assignedChoreID
                    }, function(response){
                        location.reload();
                    });
                });
            });
        }


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