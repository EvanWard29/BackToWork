<?php include '../../model/DBConnection.php';

if(isset($_POST['familyID'])){
    $db = new DBConnection();

    $data = $db->getAllChores($_POST['familyID']);

    $chores = [];

    foreach($data as $item){
        $choreID = $item->getChoreID();
        $choreName = $item->getChoreName();
        $choreDescription = $item->getChoreDescription();
        $chorePoints = $item->getPoints();
        $chorePenalty = $item->getPenalty();
        $familyID = $item->getFamilyID();

        $chores[] = array(
            "choreID" => $choreID,
            "choreName" => $choreName,
            "choreDescription" => $choreDescription,
            "chorePoints" => $chorePoints,
            "chorePenalty" => $chorePenalty,
            "familyID" => $familyID
        );
    }

    echo json_encode($chores);
}