<?php include '../../model/DBConnection.php'; //include "../controller/Chore.php";

$db = new DBConnection();

$data = $db->getUsers($_POST['familyID']);

$users = [];

foreach($data as $item){
    $userID = $item->getUserID();
    $userName = $item->getFirstName();

    $users[] = array(
        "userID" => $userID,
        "userName" => $userName
    );
}

echo json_encode($users);



