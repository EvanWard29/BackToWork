<?php include '../model/DBConnection.php'; //include "../controller/Chore.php";

$db = new DBConnection();

$data = $db->getAllChores();

$chores = [];

foreach($data as $item){
    $chore = [];

    $choreID = $item->getChoreID();
    $choreName = $item->getChoreName();
    $choreDescription = $item->getChoreDescription();

    $chore[] = $choreID;
    $chore[] = $choreName;
    $chore[] = $choreDescription;

    $chores[] = $chore;
}

echo json_encode($chores);



