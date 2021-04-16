<?php include_once "../../model/DBConnection.php";

if(isset($_POST['groupID']) && isset($_POST['assignedChoreID'])){
    $db = new DBConnection();

    echo $db->getUserChore($_POST['groupID'], $_POST['assignedChoreID']);
}
