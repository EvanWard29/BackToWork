let rewardPoints = null;
$(function(){
    /** Select Reward **/
    $('tr').click(function(){
        if($(this).attr('id').replace(/[0-9]/g, '') === "reward"){
            //Get details of selected reward
            let rewardID = $(this).attr('id').replace( /^\D+/g, '');
            let rewardName = $(this).find(".rewardName").html();
            let points = $(this).find(".rewardPoints").html();
            rewardPoints = $(this).find(".rewardPoints").html();

            //Present details of selected reward
            $('#selectedRewardID').html(rewardID);
            $('#selectedReward').val(rewardName);
            $('#selectedRewardPoints').html(points);

            $('#inpEditRewardName').val(rewardName);
            $('#inpEditRewardPoints').val(points);

            $('#btnRedeemReward').attr('disabled', false);
            $('#btnDeleteReward').attr('disabled', false);
            $('#btnEditReward').attr('disabled', false);
        }
    });

    //Present user's points
    $('#myPoints').html(getCookie("points"));

    //Show reward requests modal
    $('#btnRewardRequests').click(function(){
        $('#modalRewardRequests').modal('show');
    })

    //Show new reward modal
    $('#btnNewReward').click(function(){
        $('#modalNewReward').modal('show');
    });
});