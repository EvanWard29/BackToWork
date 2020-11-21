<?php include_once '../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['user'])) && (isset($_POST['familyID'])) && (isset($_POST['choreID']))){
    $user = $_POST['user'];
    $id = $_POST['familyID'];


}
