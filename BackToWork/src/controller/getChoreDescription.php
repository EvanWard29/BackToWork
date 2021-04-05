<?php include '../model/DBConnection.php'; //include "../controller/Chore.php";

$db = new DBConnection();

if((isset($_POST['name']))){
    $chores = $db->getAllChores();

    $choreName = $_POST['name'];

    foreach($chores as $chore){
        if($chore->getChoreName() == $choreName){
            echo $chore->getChoreDescription();
            exit;
        }
    }
}

