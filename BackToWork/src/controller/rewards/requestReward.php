<?php include '../../model/DBConnection.php';

if(isset($_POST['rewardID']) && isset($_POST['groupID']) && isset($_POST['userID'])){
    $db = new DBConnection();

    $rewardID = $_POST['rewardID'];
    $groupID = $_POST['groupID'];
    $userID = $_POST['userID'];

    $db->requestReward($rewardID, $groupID, $userID);
}