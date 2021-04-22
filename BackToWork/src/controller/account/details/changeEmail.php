<?php include_once '../../../model/DBConnection.php';

$db = new DBConnection();

if(isset($_POST['currentEmail']) && isset($_POST['newEmail'])){
    $db->changeEmail($_POST['currentEmail'], $_POST['newEmail']);
}