<?php
include '../../src/model/Calendar.php';
include_once '../header.php';

$db = new DBConnection();
$calendar = new Calendar();

$events = $db->getEvents($_COOKIE['groupID']);

?>

<html>

    <link href="../../assets/css/calendar.css" type="text/css" rel="stylesheet" />

    <!-- JS Code -->
    <script src="../../assets/js/calendar/calendarEvents.js"></script>
    <script src="../../assets/js/calendar/newEvent.js"></script>

    <body>
        <!-- Calendar -->
        <div class="container-fluid main">
            <h1>Group Calendar</h1>
            <?php echo $calendar->show(); ?>
        </div>

        <?php include "modalCalendarEvent.php" ?>

    </body>
</html>
<?php

//Go through group events and mark them on calendar
foreach($events as $event){
    $eventDate = $event->getEventDate();

    //Set background of a date to represent an event
    echo "<script>$('li[id='+ '$eventDate'.split(' ')[0] +']').css('background', '#76D8F7')</script>";
}


include_once "../footer.php";







