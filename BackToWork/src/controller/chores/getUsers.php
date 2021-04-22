<?php include '../../model/DBConnection.php';

$db = new DBConnection();

$data = $db->getUsers($_POST['groupID']);

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



