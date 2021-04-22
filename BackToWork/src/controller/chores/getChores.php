<?php include '../../model/DBConnection.php';

if(isset($_POST['groupID'])){
    $db = new DBConnection();

    $data = $db->getAllChores($_POST['groupID']);

    $chores = [];

    foreach($data as $item){
        $choreID = $item->getChoreID();
        $choreName = $item->getChoreName();
        $choreDescription = $item->getChoreDescription();
        $chorePoints = $item->getPoints();
        $chorePenalty = $item->getPenalty();
        $groupID = $item->getGroupID();

        $chores[] = array(
            "choreID" => $choreID,
            "choreName" => $choreName,
            "choreDescription" => $choreDescription,
            "chorePoints" => $chorePoints,
            "chorePenalty" => $chorePenalty,
            "groupID" => $groupID
        );
    }

    echo json_encode($chores);
}