<?php include_once '../../model/DBConnection.php';

if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['date']) && isset($_POST['familyID'])){
    $db = new DBConnection();

    $db->addEvent($_POST['name'], $_POST['description'], $_POST['date'], $_POST['familyID']);
}