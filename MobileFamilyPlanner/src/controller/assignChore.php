<?php include_once '../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['user'])) && (isset($_POST['familyID'])) && (isset($_POST['choreID']))){
    $user = $_POST['user'];
    $familyID = $_POST['familyID'];
    $choreID = $_POST['choreID'];

    $assignedChore = new AssignedChore(null,null, $choreID, $familyID, "INCOMPLETE"); //Get userID & familyID from Session

    $db->assignChore($assignedChore, $user);
}

