$(function(){
    /** Reward Requests **/
    $('tr button').click(function(){
        //User has clicked either 'APPROVE' or 'DECLINE' on reward request
        let requestID = $(this).parents('tr').attr('id').replace( /^\D+/g, '');
        let row = $(this).parents('tr');

        //Approve Request
        if($(this).html() === "APPROVE"){
            //Set Status To Approved
            $.post("/BackToWork/src/controller/rewards/approveRequest.php",{
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
            $.post("/BackToWork/src/controller/rewards/declineRequest.php",{
                requestID: requestID
            }, function(response){
                console.log(response);
                row.remove();
                if($('#requests >tbody >tr').length === 0){
                    $('#requests').attr('hidden', true);
                    $('#noRequests').attr('hidden', false);
                }
            });
        }
    });
});