<?php include_once '../../../model/DBConnection.php';

$db = new DBConnection();

if(isset($_POST['email']) && isset($_POST['password'])){
    $db->changePassword($_POST['email'], $_POST['password']);
}
