$(function(){
    //Change modal from view event to new event layout
    $('#btnNewEvent').click(function(){
        $('#viewData').attr('hidden', true);
        $('#newEvent').attr('hidden', false);

        $('#btnCancel').attr('hidden', false);
        $('#btnClose').attr('hidden', true);

        $('#btnAddEvent').attr('hidden', false);
        $('#btnNewEvent').attr('hidden', true);
    });

    /** New Event **/
    $('#btnAddEvent').click(function(){
        let eventName = $('#inpEventName').val();
        let eventDescription = $('#inpEventDescription').val();

        let nameErr = false;
        let descriptionErr = false;

        /* Perform validation techniques on user inputs */

        //Event Name
        if(eventName === ""){
            //Name is Empty
            nameErr = true;

            $('#invEventName').attr('hidden', false);
        }else{
            if(eventName.length > 45){
                //Name has more than 45 characters
                nameErr = true;

                $('#invEventName').attr('hidden', false);
            }else{
                nameErr = false;
                $('#invEventName').attr('hidden', true);
            }
        }

        //Event Description
        if(eventDescription === ""){
            //Description is Empty
            descriptionErr = true;

            $('#invEventDescription').attr('hidden', false);
        }else{
            if(eventDescription.length > 100){
                //Description has more than 100 characters
                descriptionErr = true;

                $('#invEventDescription').attr('hidden', false);
            }else{
                descriptionErr = false;
                $('#invEventDescription').attr('hidden', true);
            }
        }

        if(nameErr !== true && descriptionErr !== true){
            //No Errors in inputs - send data to server
            $.post("/BackToWork/src/controller/calendar/addEvent.php", {
                name: eventName,
                description: eventDescription,
                date: $('#lblEventDate').html(),
                groupID: getCookie('groupID')
            }, function(response){
                location.reload();
            });
        }
    });
});