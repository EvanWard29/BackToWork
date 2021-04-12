<?php
include '../src/model/calendar.php';
include_once 'header.php';

$db = new DBConnection();
$calendar = new calendar();

//Build Calendar
echo $calendar->show();

$events = $db->getEvents($_COOKIE['familyID']);

?>


<html>
<head>
    <!-- Style Calendar -->
    <!--<link href="../assets/css/calendar.css" type="text/css" rel="stylesheet" />-->
    <script src="../assets/js/calendarEvents.js"></script>
    <style>
        /*******************************Calendar Top Navigation*********************************/
        div#calendar{
            margin:0px auto;
            padding:0px;
            width: 602px;
            font-family:Helvetica, "Times New Roman", Times, serif;
        }

        div#calendar div.box{
            position:relative;
            top:0px;
            left:0px;
            width:100%;
            height:40px;
            background-color:   #787878 ;
        }

        div#calendar div.calendarHeader{
            line-height:40px;
            vertical-align:middle;
            position:absolute;
            left:11px;
            top:0px;
            width:582px;
            height:40px;
            text-align:center;
        }

        div#calendar div.calendarHeader a.prev,div#calendar div.calendarHeader a.next{
            position:absolute;
            top:0px;
            height: 17px;
            display:block;
            cursor:pointer;
            text-decoration:none;
            color:#FFF;
        }

        div#calendar div.calendarHeader span.title{
            color:#FFF;
            font-size:18px;
        }


        div#calendar div.calendarHeader a.prev{
            left:0px;
        }

        div#calendar div.calendarHeader a.next{
            right:0px;
        }




        /*******************************Calendar Content Cells*********************************/
        div#calendar div.box-content{
            border:1px solid #787878 ;
            border-top:none;
        }



        div#calendar ul.label{
            float:left;
            margin: 0px;
            padding: 0px;
            margin-top:5px;
            margin-left: 5px;
        }

        div#calendar ul.label li{
            margin:0px;
            padding:0px;
            margin-right:5px;
            float:left;
            list-style-type:none;
            width:80px;
            height:40px;
            line-height:40px;
            vertical-align:middle;
            text-align:center;
            color:#000;
            font-size: 15px;
            background-color: transparent;
        }


        div#calendar ul.dates{
            float:left;
            margin: 0px;
            padding: 0px;
            margin-left: 5px;
            margin-bottom: 5px;
        }

        /** overall width = width+padding-right**/
        div#calendar ul.dates li{
            margin:0px;
            padding:0px;
            margin-right:5px;
            margin-top: 5px;
            line-height:80px;
            vertical-align:middle;
            float:left;
            list-style-type:none;
            width:80px;
            height:80px;
            font-size:25px;
            background-color: #DDD;
            color:#000;
            text-align:center;
        }

        :focus{
            outline:none;
        }

        div.clear{
            clear:both;
        }
    </style>
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
                                <tr><th>Chore</th><th>Description</th><th>Assigned To</th></tr>
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







