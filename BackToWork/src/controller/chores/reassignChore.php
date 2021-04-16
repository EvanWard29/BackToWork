<?php include_once '../../model/DBConnection.php';

$db = new DBConnection();

if(isset($_POST['user']) && isset($_POST['groupID']) && isset($_POST['assignedChoreID'])){
    $db->reassignChore($_POST['assignedChoreID'], $_POST['user'], $_POST['groupID']);
}

