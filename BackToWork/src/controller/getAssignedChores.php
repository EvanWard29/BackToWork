<?php include '../model/DBConnection.php'; //include "../controller/Chore.php";

$db = new DBConnection();

$data = $db->getAssignedChores($_POST['familyID']);

$assignedChores = [];

foreach($data as $item){
    $assignedChore = [];

    $assignedChoreID = $item->getAssignedChoreID();
    $userID = $item->getUserID();
    $choreID = $item->getChoreID();
    $status = $item->getStatus();

    $assignedChore[] = $assignedChoreID;
    $assignedChore[] = $userID;
    $assignedChore[] = $choreID;
    $assignedChore[] = $status;

    $assignedChores[] = $assignedChore;
}

echo json_encode($assignedChores);



