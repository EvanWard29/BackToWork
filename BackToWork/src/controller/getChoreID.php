<?php include '../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['name']))){
    $chores = $db->getAllChores();

    $choreName = $_POST['name'];

    foreach($chores as $chore){
        if($chore->getChoreName() == $choreName){
            echo $chore->getChoreID();
            exit;
        }
    }
}

