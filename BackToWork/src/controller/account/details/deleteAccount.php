<?php include_once "../../../model/DBConnection.php";

if(isset($_POST['userID']) && isset($_POST['groupID'])){
    $db = new DBConnection();

    $db->deleteAccount($_POST['userID'], $_POST['groupID']);
}
