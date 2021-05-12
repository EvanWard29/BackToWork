<?php include_once '../../../model/DBConnection.php';

$db = new DBConnection();

if((isset($_POST['firstName'])) && (isset($_POST['lastName'])) && (isset($_POST['groupName'])) && (isset($_POST['type'])) && (isset($_POST['dob'])) && (isset($_POST['email'])) && (isset($_POST['password']))){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $groupName = $_POST['groupName'];
    $type = $_POST['type'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $groupID = $_POST['groupID'];
    serialize($password);

    $user = new User(null, $firstName, $lastName, $type, $dob, $email, $password, 0, 0, $groupID);

    $db->addUser($user, $groupName);
}