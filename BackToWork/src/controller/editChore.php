<?php include_once '../model/DBConnection.php'; //include "../model/Chore.php";

$db = new DBConnection();

if((isset($_POST['id'])) && (isset($_POST['name'])) && (isset($_POST['description'])) && (isset($_POST['points']))){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $points = $_POST['points'];

    $db->editChore($id, $name, $description, $points);
}

