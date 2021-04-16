<?php include_once '../../../model/DBConnection.php';

if(isset($_POST['email'])){
    $db = new DBConnection();

    echo $db->checkEmail($_POST['email']);
}
