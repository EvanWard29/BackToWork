<?php include_once "../../model/DBConnection.php";

if(isset($_POST['groupID'])){
    $db = new DBConnection();

    $db->disbandGroup($_POST['groupID']);
}
