<?php include_once '../model/DBConnection.php';

$db = new DBConnection();

if(isset($_POST['userID']) && isset($_POST['firstName']) && isset($_POST['choresCompleted']) && isset($_POST['points'])){
    $userID = $_POST['userID'];
    $name = $_POST['firstName'];
    $choresCompleted = $_POST['choresCompleted'];
    $points = $_POST['points'];

    $db->updateUser($userID, $name, $choresCompleted, $points);
}
