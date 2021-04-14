<?php include_once '../../model/DBConnection.php';

if(isset($_POST['assignedChoreID']) && isset($_POST['points'])){
    $db = new DBConnection();

    $db->updatePoints($_POST['assignedChoreID'], $_POST['points']);
}
