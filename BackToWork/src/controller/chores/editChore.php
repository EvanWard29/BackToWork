<?php include_once '../../model/DBConnection.php';

if((isset($_POST['id'])) && (isset($_POST['name'])) && (isset($_POST['description'])) && (isset($_POST['points'])) && (isset($_POST['penalty'])) && (isset($_POST['groupID']))){
    $db = new DBConnection();

    $chore = new Chore($_POST['id'], $_POST['name'], $_POST['description'], $_POST['points'], $_POST['penalty'], $_POST['groupID']);
    $db->editChore($chore);
}

