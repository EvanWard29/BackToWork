<?php include_once '../../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['user'])) && (isset($_POST['groupID'])) && (isset($_POST['choreID'])) && (isset($_POST['deadline']))){
    $user = $_POST['user'];
    $groupID = $_POST['groupID'];
    $choreID = $_POST['choreID'];
    $deadline = $_POST['deadline'];

    $assignedChore = new AssignedChore(null,null, $choreID, $groupID, $deadline, "INCOMPLETE");

    $db->assignChore($assignedChore, $user);
}

