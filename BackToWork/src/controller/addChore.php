<?php include_once '../model/DBConnection.php'; //include "../model/Chore.php";

$db = new DBConnection();

if((isset($_POST['name']) && (isset($_POST['description'])) && (isset($_POST['points'])))){
    $choreName = $_POST['name'];
    $choreDescription = $_POST['description'];
    $points = $_POST['points'];

    $newChore = new Chore(null, $choreName, $choreDescription, $points);
    $db->addChore($newChore);
}