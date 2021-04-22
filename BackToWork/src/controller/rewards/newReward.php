<?php include_once '../../model/DBConnection.php';

if(isset($_POST['rewardName']) && isset($_POST['pointsCost']) && isset($_POST['groupID'])){
    $db = new DBConnection();

    $db->addNewReward($_POST['rewardName'], $_POST['pointsCost'], $_POST['groupID']);
}
