<?php include_once '../../model/DBConnection.php';

if(isset($_POST['requestID'])){
    $db = new DBConnection();

    $db->declineRequest($_POST['requestID']);
}

