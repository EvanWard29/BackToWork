<?php include '../model/DBConnection.php';

if(isset($_POST['rewardID']) && isset($_POST['familyID']) && isset($_POST['userID'])){
    $db = new DBConnection();

    $rewardID = $_POST['rewardID'];
    $familyID = $_POST['familyID'];
    $userID = $_POST['userID'];

    $db->requestReward($rewardID, $familyID, $userID);
}