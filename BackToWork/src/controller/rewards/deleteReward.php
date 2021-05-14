<?php include_once '../../model/DBConnection.php';

if(isset($_POST['rewardID'])){
    $db = new DBConnection();

    $db->deleteReward($_POST['rewardID']);
}