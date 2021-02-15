<?php include_once '../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['firstName'])) && (isset($_POST['lastName'])) && (isset($_POST['email'])) && (isset($_POST['password']))){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    serialize($password);

    $user = new User(null, $firstName, $lastName, $email, $password, 0, 0, 1); //Get familyID from SESSION

    $db->addUser($user);
    echo("HELLO!!!!!!!!!!!!!");
}
