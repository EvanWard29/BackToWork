$(function(){
    $('#myPoints').html(getCookie("points"));

    $('tr').click(function(){
        if($(this).attr('id').replace(/[0-9]/g, '') === "reward"){
            let rewardID = $(this).attr('id').replace( /^\D+/g, '');
            let rewardName = $(this).find(".rewardName").html();
            let points = $(this).find(".rewardPoints").html();

            $('#selectedRewardID').html(rewardID);
            $('#selectedReward').val(rewardName);
            $('#selectedRewardPoints').html(points);

            $('#btnRedeemReward').attr('disabled', false);
        }
    });

    $('tr button').click(function(){
        let requestID = $(this).parents('tr').attr('id').replace( /^\D+/g, '');
        let row = $(this).parents('tr');

        //Approve Request
        if($(this).html() === "APPROVE"){
            //Set Status To Approved
            $.post("/BackToWork/src/controller/approveRequest.php",{
                requestID: requestID
            }, function(response){
                row.remove();
                if($('#requests >tbody >tr').length === 0){
                    $('#requests').attr('hidden', true);
                    $('#noRequests').attr('hidden', false);
                }
            });
        }

        //Decline Request
        if($(this).html() === "DECLINE"){
            //Set Status To Declined
            $.post("/BackToWork/src/controller/declineRequest.php",{
                requestID: requestID
            }, function(response){
                row.remove();
                if($('#requests >tbody >tr').length === 0){
                    $('#requests').attr('hidden', true);
                    $('#noRequests').attr('hidden', false);
                }
            });
        }

    });

    $('#btnRedeemReward').click(function(){
        let userPoints = getCookie('points');

        //See if user has enough points
        let selectedRewardID = $('#selectedRewardID').html();
        let selectedRewardCost = $('#selectedRewardPoints').html();

        if((userPoints - selectedRewardCost) >= 0){
            $('#rewardErr').attr('hidden', true);
            $('#selectedReward').removeClass('is-invalid');

            //User has enough points
            let newPoints = userPoints - selectedRewardCost;

            $.post("/BackToWork/src/controller/requestReward.php", {
                rewardID: selectedRewardID,
                familyID: getCookie('familyID'),
                userID: getCookie('userID')
            }, function(response){
                document.cookie = "points=" + newPoints;
                location.reload();
            });
        }else{
            //User doesn't have enough points
            $('#rewardErr').attr('hidden', false);
            $('#selectedReward').addClass('is-invalid');
        }
    });

    $('#btnRewardRequests').click(function(){
        $('#modalRewardRequests').modal('show');
    })

    $('#btnNewReward').click(function(){
        $('#modalNewReward').modal('show');
    });

    $('#btnAddReward').click(function(){
        let rewardName = $('#inpRewardName').val();
        let pointsCost = $('#inpPointsCost').val();

        //Validation

        let nameErr = false;
        let pointsErr = false;
        if(rewardName === ""){
            //Empty
            $('#rewardNameErr').attr('hidden', false);
            nameErr = true;
        }else{
            $('#rewardNameErr').attr('hidden', true);
            nameErr = false;
        }

        if(pointsCost === ""){
            //Empty
            $('#pointsCostErr').attr('hidden', false);
            pointsErr = true;
        }else{
            //Check if Number
            if(isNaN(pointsCost) === true){
                //Not a number
                $('#pointsCostErr').attr('hidden', false);
                pointsErr = true;
            }else{
                $('#pointsCostErr').attr('hidden', true);
                pointsErr = false;
            }
        }

        if(nameErr !== true && pointsErr !== true){
            //No Errors
            $.post("/BackToWork/src/controller/newReward.php", {
                rewardName: rewardName,
                pointsCost: pointsCost,
                familyID: getCookie('familyID')
            }, function(response){

            });
            location.reload();
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