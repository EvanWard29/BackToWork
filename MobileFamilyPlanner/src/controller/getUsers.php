<?php include '../model/DBConnection.php'; //include "../controller/Chore.php";

$db = new DBConnection();

$data = $db->getUsers(1);

$users = [];

foreach($data as $item){
    $user = [];

    $userID = $item->getUserID();
    $userName = $item->getFirstName();

    $user[] = $userID;
    $user[] = $userName;

    $users[] = $user;
}

echo json_encode($users);



