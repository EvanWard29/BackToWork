<?php include '../../model/DBConnection.php'; //include "../controller/Chore.php";

$db = new DBConnection();

$data = $db->getAssignedChores($_POST['familyID']);

$assignedChores = [];

foreach($data as $item){
    $assignedChoreID = $item->getAssignedChoreID();
    $userID = $item->getUserID();
    $choreID = $item->getChoreID();
    $deadline = $item->getDeadline();
    $status = $item->getStatus();

    $assignedChores[] = array(
        "assignedChoreID" => $assignedChoreID,
        "userID" => $userID,
        "choreID" => $choreID,
        "deadline" => $deadline,
        "status" => $status
    );
}

echo json_encode($assignedChores);



