$(function(){
    /** New Reward **/
    $('#btnAddReward').click(function(){
        let nameErr = false;
        let pointsErr = false;

        //Get new reward details
        let rewardName = $('#inpRewardName').val();
        let pointsCost = $('#inpPointsCost').val();

        //Perform validation techniques on user inputs
        if(rewardName === ""){
            //Empty reward name
            $('#rewardNameErr').attr('hidden', false);
            $('#inpRewardName').addClass('is-invalid');
            nameErr = true;
        }else{
            if(rewardName.length > 45){
                //Reward name too long
                $('#rewardNameErr').attr('hidden', false);
                $('#inpRewardName').addClass('is-invalid');

                nameErr = true;
            }else{
                $('#rewardNameErr').attr('hidden', true);
                $('#inpRewardName').removeClass('is-invalid');

                nameErr = false;
            }
        }

        if(pointsCost === ""){
            //Empty points cost
            $('#pointsCostErr').attr('hidden', false);
            $('#inpPointsCost').addClass('is-invalid');

            pointsErr = true;
        }else{
            //Check if Number
            if(isNaN(pointsCost) === true){
                //Not a number
                $('#pointsCostErr').attr('hidden', false);
                $('#inpPointsCost').addClass('is-invalid');

                pointsErr = true;
            }else{
                $('#pointsCostErr').attr('hidden', true);
                $('#inpPointsCost').removeClass('is-invalid');

                pointsErr = false;
            }
        }

        //If all checks pass
        if(nameErr !== true && pointsErr !== true){
            //Add new Reward to DB
            $.post("/BackToWork/src/controller/rewards/newReward.php", {
                rewardName: rewardName,
                pointsCost: pointsCost,
                groupID: getCookie('groupID')
            }, function(response){

            });
            location.reload();
        }
    });
});