<?php
include_once '../../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['choreID'])) && (isset($_POST['groupID']))){
    $choreID = $_POST['choreID'];
    $groupID = $_POST['groupID'];

    $db->deleteChore($choreID, $groupID);

}