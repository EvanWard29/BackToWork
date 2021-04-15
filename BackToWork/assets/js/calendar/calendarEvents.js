$(async function(){
    let events = null;

    //Get All Calendar Events
    await $.post("/BackToWork/src/controller/calendar/getEvents.php", {
        familyID: getCookie('familyID')
    }, function(response){
        events = JSON.parse(response);
    })

    $('li').click(async function(){
       if($(this).attr('id') !== ""){
           //User has clicked on a date

           let date = $(this).attr('id');
           $('#lblEventDate').html(date);

           for(let i = 0; i < events.length; i++){
               if(events[i].eventDate.split(' ')[0] === $(this).attr('id')){
                   if(events[i].eventType === "CHORE"){
                       let choreName = events[i].eventName;
                       let choreDescription = events[i].eventDescription;

                       let deadline = events[i].eventDate.split(' ')[1];

                       let assignedChoreID = events[i].assignedChoreID;
                       let assignedTo = null;

                       await $.post("/BackToWork/src/controller/calendar/getUserChore.php",{
                           familyID: getCookie('familyID'),
                           assignedChoreID: assignedChoreID
                       }, function(response){
                            assignedTo = response;
                       });


                       //Add CHORE to chores table
                       $('#chores').append("<tr><td>"+ choreName +"</td><td>"+ choreDescription +"</td><td>"+ deadline +"</td><td>"+ assignedTo +"</td></tr>");
                   }else{
                       let eventName = events[i].eventName;
                       let eventDescription = events[i].eventDescription;

                       //Add EVENT to events table
                       $('#events').append("<tr><td>"+ eventName +"</td><td>"+ eventDescription +"</td></tr>");
                   }
               }
           }

           if($('#choresData').children().length === 0){
               $('#chores').attr('hidden', true);
               $('#noChores').attr('hidden', false);
           }else{
               $('#chores').attr('hidden', false);
               $('#noChores').attr('hidden', true);
           }

           if($('#eventsData').children().length === 0){
               $('#events').attr('hidden', true);
               $('#noEvents').attr('hidden', false);
           }else{
               $('#events').attr('hidden', false);
               $('#noEvents').attr('hidden', true);
           }

           $('#modalCalendarEvent').modal('show');
       }
    });

    $('#btnNewEvent').click(function(){
        $('#viewData').attr('hidden', true);
        $('#newEvent').attr('hidden', false);

        $('#btnCancel').attr('hidden', false);
        $('#btnClose').attr('hidden', true);

        $('#btnAddEvent').attr('hidden', false);
        $('#btnNewEvent').attr('hidden', true);
    });

    $('#btnCancel').click(function(){
        $('#btnClose').attr('hidden', false);
        $('#btnCancel').attr('hidden', true);

        $('#btnAddEvent').attr('hidden', true);
        $('#btnNewEvent').attr('hidden', false);

        $('#viewData').attr('hidden', false);
        $('#newEvent').attr('hidden', true);

        $('#invEventDescription').attr('hidden', true);
        $('#invEventName').attr('hidden', true);
    });

    $('#modalCalendarEvent').on('hide.bs.modal', function(){
        $('#viewData').attr('hidden', false);
        $('#newEvent').attr('hidden', true);
        $('#btnAddEvent').attr('hidden', true);
        $('#btnNewEvent').attr('hidden', false);

        $('#events').attr('hidden', true);
        $('#chores').attr('hidden', true);

        //Remove Events from table when modal is closed
        $('#eventsData').empty();
        $('#choresData').empty();

        $('#invEventDescription').attr('hidden', true);
        $('#invEventName').attr('hidden', true);
    });

    $('#btnAddEvent').click(function(){
        let eventName = $('#inpEventName').val();
        let eventDescription = $('#inpEventDescription').val();

        let nameErr = false;
        let descriptionErr = false;

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
            //No Errors
            $.post("/BackToWork/src/controller/calendar/addEvent.php", {
                name: eventName,
                description: eventDescription,
                date: $('#lblEventDate').html(),
                familyID: getCookie('familyID')
            }, function(response){
                location.reload();
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