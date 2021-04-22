<?php include_once '../../model/DBConnection.php';

if(isset($_POST['groupID'])){
    $db = new DBConnection();

    $data = $db->getEvents($_POST['groupID']);

    $events = [];

    foreach($data as $item){
        $eventID = $item->getEventID();
        $eventName = $item->getEventName();
        $eventDescription = $item->getEventDescription();
        $eventType = $item->getEventType();
        $eventDate = $item->getEventDate();
        $groupID = $item->getGroupID();
        $assignedChoreID = $item->getAssignedChoreID();

        $events[] = array(
            "eventID" => $eventID,
            "eventName" => $eventName,
            "eventDescription" => $eventDescription,
            "eventType" => $eventType,
            "eventDate" => $eventDate,
            "groupID" => $groupID,
            "assignedChoreID" => $assignedChoreID);
    }

    echo json_encode($events);
}