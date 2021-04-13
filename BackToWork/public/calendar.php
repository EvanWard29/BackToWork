<?php
include '../src/model/Calendar.php';
include_once 'header.php';

$db = new DBConnection();
$calendar = new Calendar();

//Build Calendar
echo $calendar->show();

$events = $db->getEvents($_COOKIE['familyID']);

?>

<html>
<head>
    <link href="../assets/css/calendar.css" type="text/css" rel="stylesheet" />
    <script src="../assets/js/calendar/calendarEvents.js"></script>
</head>
    <body>

    <!-- Modal Calendar Event -->
    <div class="modal fade" id="modalCalendarEvent" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lblEventDate"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="viewData">
                        <h5>Events</h5>
                        <label id="noEvents" hidden>No Events Added</label>
                        <table id="events" class="table-bordered">
                            <thead>
                                <tr><th>Event Name</th><th>Event Description</th></tr>
                            </thead>
                            <tbody id="eventsData">

                            </tbody>
                        </table>

                        <h5>Chores</h5>
                        <label id="noChores" hidden>No Chores Added</label>
                        <table id="chores" class="table-bordered">
                            <thead>
                                <tr><th>Chore</th><th>Description</th><th>Deadline</th><th>Assigned To</th></tr>
                            </thead>
                            <tbody id="choresData">

                            </tbody>
                        </table>
                    </div>

                    <div id="newEvent" hidden>
                        <h5>New Event</h5>
                        <form>
                            <div class="form-group">
                                <label class="font-weight-bold" for="inpEventName">Event Name:</label>
                                <label class="text-danger" id="invEventName" hidden>Name Cannot Be Empty or Contain More Than 45 Characters!</label>
                                <input id="inpEventName" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="inpEventDescription">Event Description:</label>
                                <label class="text-danger" id="invEventDescription" hidden>Description Cannot Be Empty or Contain More Than 100 Characters!</label>
                                <textarea id="inpEventDescription" class="form-control"></textarea>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnNewEvent">New Event</button>
                    <button type="button" class="btn btn-primary" id="btnAddEvent" hidden>Add Event</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnClose">Close</button>
                    <button type="button" class="btn btn-danger" id="btnCancel" hidden>Cancel</button>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>
<?php

foreach($events as $event){
    $eventDate = $event->getEventDate();

    //Set background of a date to represent an event
    echo "<script>$('li[id='+ '$eventDate'.split(' ')[0] +']').css('background', '#76D8F7')</script>";
}







