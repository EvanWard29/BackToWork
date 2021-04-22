$(function(){
    /** Redeem Reward **/
    $('#btnRedeemReward').click(function(){
        let userPoints = getCookie('points');

        //See if user has enough points to redeem
        let selectedRewardID = $('#selectedRewardID').html();
        let selectedRewardCost = $('#selectedRewardPoints').html();

        if((userPoints - selectedRewardCost) >= 0){
            //User has enough points
            $('#rewardErr').attr('hidden', true);
            $('#selectedReward').removeClass('is-invalid');

            //Calculate user's new points
            let newPoints = userPoints - selectedRewardCost;

            //Save request to DB
            $.post("/BackToWork/src/controller/rewards/requestReward.php", {
                rewardID: selectedRewardID,
                groupID: getCookie('groupID'),
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
});