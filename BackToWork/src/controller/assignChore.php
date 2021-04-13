<?php include_once '../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['user'])) && (isset($_POST['familyID'])) && (isset($_POST['choreID'])) && (isset($_POST['deadline']))){
    $user = $_POST['user'];
    $familyID = $_POST['familyID'];
    $choreID = $_POST['choreID'];
    $deadline = $_POST['deadline'];

    $assignedChore = new AssignedChore(null,null, $choreID, $familyID, $deadline, "INCOMPLETE"); //Get userID & familyID from Session

    $db->assignChore($assignedChore, $user);
}

