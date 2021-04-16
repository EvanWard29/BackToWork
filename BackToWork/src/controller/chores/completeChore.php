<?php include_once '../../model/DBConnection.php';

$db = new DBConnection();

if(isset($_POST['assignedChoreID']) && isset($_POST['groupID'])){
    $db->completeChore($_POST['assignedChoreID'], $_POST['groupID']);
}
