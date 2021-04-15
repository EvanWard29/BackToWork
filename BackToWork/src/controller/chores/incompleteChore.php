<?php include_once '../../model/DBConnection.php';

$db = new DBConnection();

if(isset($_POST['assignedChoreID'])){
    $db->incompleteChore($_POST['assignedChoreID']);
}
