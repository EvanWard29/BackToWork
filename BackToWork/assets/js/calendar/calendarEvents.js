$(async function(){
    let events = null;

    //Get All Calendar Events For User's Group
    await $.post("/BackToWork/src/controller/calendar/getEvents.php", {
        groupID: getCookie('groupID')
    }, function(response){
        events = JSON.parse(response);
    })

    /** Calendar Events **/
    $('li').click(async function(){
       if($(this).attr('id') !== ""){
           //User has clicked on a date in the calendar
           let date = $(this).attr('id');
           $('#lblEventDate').html(date);

           //Go through all events
           for(let i = 0; i < events.length; i++){
               //If the selected date has events already, display their details.
               if(events[i].eventDate.split(' ')[0] === $(this).attr('id')){
                   if(events[i].eventType === "CHORE"){
                       //Event is an Assigned Chore - Get details
                       let choreName = events[i].eventName;
                       let choreDescription = events[i].eventDescription;

                       let deadline = events[i].eventDate.split(' ')[1];

                       let assignedChoreID = events[i].assignedChoreID;
                       let assignedTo = null;

                       //Get name of assigned user
                       await $.post("/BackToWork/src/controller/calendar/getUserChore.php",{
                           groupID: getCookie('groupID'),
                           assignedChoreID: assignedChoreID
                       }, function(response){
                            assignedTo = response;
                       });


                       //Add CHORE to chores table
                       $('#chores').append("<tr><td>"+ choreName +"</td><td>"+ choreDescription +"</td><td>"+ deadline +"</td><td>"+ assignedTo +"</td></tr>");
                   }else{
                       //Event is a user added event.
                       let eventName = events[i].eventName;
                       let eventDescription = events[i].eventDescription;

                       //Add EVENT to events table
                       $('#events').append("<tr><td>"+ eventName +"</td><td>"+ eventDescription +"</td></tr>");
                   }
               }
           }

           //If there are no CHORES for selected date, display a warning
           if($('#choresData').children().length === 0){
               $('#chores').attr('hidden', true);
               $('#noChores').attr('hidden', false);
           }else{
               $('#chores').attr('hidden', false);
               $('#noChores').attr('hidden', true);
           }

           //If there are no EVENTS for selected date, display a warning
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

    //Cancel new event and revert back to view event layout
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

    //Tidy up modal when closed
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
});