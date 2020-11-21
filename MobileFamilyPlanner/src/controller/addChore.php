<?php include_once '../model/DBConnection.php'; //include "../model/Chore.php";

$db = new DBConnection();

if((isset($_POST['name']) && (isset($_POST['description'])))){
    $choreName = $_POST['name'];
    $choreDescription = $_POST['description'];

    $newChore = new Chore(null, $choreName, $choreDescription);
    $db->addChore($newChore);
}

