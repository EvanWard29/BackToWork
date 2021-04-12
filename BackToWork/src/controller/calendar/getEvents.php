<?php include_once '../../model/DBConnection.php';

if(isset($_POST['familyID'])){
    $db = new DBConnection();

    $data = $db->getEvents($_POST['familyID']);

    $events = [];

    foreach($data as $item){
        //$event = [];

        $eventID = $item->getEventID();
        $eventName = $item->getEventName();
        $eventDescription = $item->getEventDescription();
        $eventType = $item->getEventType();
        $eventDate = $item->getEventDate();
        $familyID = $item->getFamilyID();
        $assignedChoreID = $item->getAssignedChoreID();

        /*$event[] = $eventID;
        $event[] = $eventName;
        $event[] = $eventDescription;
        $event[] = $eventType;
        $event[] = $eventDate;
        $event[] = $familyID;
        $event[] = $assignedChoreID;*/

        $events[] = array(
            "eventID" => $eventID,
            "eventName" => $eventName,
            "eventDescription" => $eventDescription,
            "eventType" => $eventType,
            "eventDate" => $eventDate,
            "familyID" => $familyID,
            "assignedChoreID" => $assignedChoreID);
    }

    echo json_encode($events);
}