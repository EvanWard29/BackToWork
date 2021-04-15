<?php include_once '../../model/DBConnection.php';

$db = new DBConnection();

if(isset($_POST['assignedChoreID'])){
    $db->completeChore($_POST['assignedChoreID']);
}
