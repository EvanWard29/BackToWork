<?php include_once '../../model/DBConnection.php';

if(isset($_POST['rewardID']) && isset($_POST['rewardName']) && isset($_POST['rewardPoints'])){
    $db = new DBConnection();

    $reward = new Reward($_POST['rewardID'], $_POST['rewardName'], $_POST['rewardPoints']);
    $db->updateReward($reward);
}