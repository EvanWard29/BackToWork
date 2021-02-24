<?php include '../model/DBConnection.php'; //include "../controller/Chore.php";

$db = new DBConnection();

$data = $db->getAllChores();

$chores = [];

foreach($data as $item){
    $chore = [];

    $choreID = $item->getChoreID();
    $choreName = $item->getChoreName();
    $choreDescription = $item->getChoreDescription();
    $chorePoints = $item->getPoints();

    $chore[] = $choreID;
    $chore[] = $choreName;
    $chore[] = $choreDescription;
    $chore[] = $chorePoints;

    $chores[] = $chore;
}

echo json_encode($chores);



