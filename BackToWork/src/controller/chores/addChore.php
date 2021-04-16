<?php include_once '../../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['name']) && (isset($_POST['description'])) && (isset($_POST['points'])) && (isset($_POST['penalty'])) && (isset($_POST['groupID'])))){
    $choreName = $_POST['name'];
    $choreDescription = $_POST['description'];
    $points = $_POST['points'];
    $penalty = $_POST['penalty'];
    $groupID = $_POST['groupID'];

    $newChore = new Chore(null, $choreName, $choreDescription, $points, $penalty, $groupID);
    $db->addChore($newChore);
}