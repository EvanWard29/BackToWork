<?php include_once '../model/DBConnection.php';

$db = new DBConnection();

if(isset($_POST['user']) && isset($_POST['familyID']) && isset($_POST['assignedChoreID'])){
    $db->reassignChore($_POST['assignedChoreID'], $_POST['user'], $_POST['familyID']);
}

