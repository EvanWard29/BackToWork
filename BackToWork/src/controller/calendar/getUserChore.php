<?php include_once "../../model/DBConnection.php";

if(isset($_POST['familyID']) && isset($_POST['assignedChoreID'])){
    $db = new DBConnection();

    echo $db->getUserChore($_POST['familyID'], $_POST['assignedChoreID']);
}
