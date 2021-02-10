<?php
include_once '../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['choreID']))){
    $choreID = $_POST['choreID'];

    $db->deleteChore($choreID);

}