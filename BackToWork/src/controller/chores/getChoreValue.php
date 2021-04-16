<?php include_once '../../model/DBConnection.php';

if(isset($_POST['assignedChoreID'])){
    $db = new DBConnection();

    echo $db->getChoreValue($_POST['assignedChoreID']);
}
