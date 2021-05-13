$(function(){
    $('#btnEditReward').click(function(){
        $('#modalEditReward').modal('show');
    });

    $('#btnSaveReward').click(function(){
        //Validation
        let rewardName = $('#inpEditRewardName').val();
        let rewardPoints = $('#inpEditRewardPoints').val();

        let rewardNameErr = false;
        let rewardPointsErr = false;

        if(rewardName === ""){
            //Reward name blank
            $('#invEditRewardName').attr('hidden', false);
            $('#inpEditRewardName').addClass('is-invalid');

            rewardNameErr = true;
        }else{
            //Reward not blank
            if(rewardName.length > 45){
                //reward too long
                $('#invEditRewardName').attr('hidden', false);
                $('#inpEditRewardName').addClass('is-invalid');

                rewardNameErr = true;
            }else{
                //No errors
                $('#invEditRewardName').attr('hidden', true);
                $('#inpEditRewardName').removeClass('is-invalid');

                rewardNameErr = false;
            }
        }

        if(rewardPoints === ""){
            //Points are blank
            $('#invEditRewardPoints').attr('hidden', false);
            $('#inpEditRewardPoints').addClass('is-invalid');

            rewardPointsErr = true;
        }else{
            //Points are not blank
            $('#invEditRewardPoints').attr('hidden', true);
            $('#inpEditRewardPoints').removeClass('is-invalid');

            rewardPointsErr = false;
        }

        if(rewardNameErr !== true && rewardPointsErr !== true){
            $('#modalEditReward').modal('hide');
            $('#modalConfirmEditReward').modal('show');
        }
    })

    $('#btnDeleteReward').click(function(){
        $('#modalConfirmDeleteReward').modal("show");
    });

    $('#btnConfirmDeleteReward').click(function(){
        let selectedRewardID = $('#selectedRewardID').html();
        $.post("/BackToWork/src/controller/rewards/deleteReward.php", {
            rewardID: selectedRewardID
        }, function(response){
            //location.reload();
            console.log(response);
        });
    });

    $('#btnConfirmEditReward').click(function(){
        let rewardID = $('#selectedRewardID').html();
        let rewardName = $('#inpEditRewardName').val();
        let rewardPoints = $('#inpEditRewardPoints').val();

        $.post("/BackToWork/src/controller/rewards/updateReward.php", {
            rewardID: rewardID,
            rewardName: rewardName,
            rewardPoints: rewardPoints
        }, function(response){
            location.reload();
        });
    });

    $('#btnCancelRewardEdit').click(function(){
        $('#invEditRewardName').attr('hidden', true);
        $('#inpEditRewardName').removeClass('is-invalid').val($('#selectedReward').val());

        $('#invEditRewardPoints').attr('hidden', true);
        $('#inpEditRewardPoints').removeClass('is-invalid').val(rewardPoints);
    });

    $('#btnCloseRewardEdit').click(function(){
        $('#invEditRewardName').attr('hidden', true);
        $('#inpEditRewardName').removeClass('is-invalid').val($('#selectedReward').val());

        $('#invEditRewardPoints').attr('hidden', true);
        $('#inpEditRewardPoints').removeClass('is-invalid').val(rewardPoints);
    });
});