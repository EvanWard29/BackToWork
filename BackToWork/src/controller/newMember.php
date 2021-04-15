<?php include_once '../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['firstName'])) && (isset($_POST['lastName'])) && (isset($_POST['type'])) && (isset($_POST['email'])) && (isset($_POST['password']))){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $type = $_POST['type'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $familyID = $_POST['familyID'];
    serialize($password);

    $user = new User(null, $firstName, $lastName, $type, $email, $password, 0, 0, $familyID); //Get familyID from SESSION

    $db->addUser($user);
}