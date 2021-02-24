<?php include_once '../model/DBConnection.php';
$db = new DBConnection();

if(isset($_POST['inpLgnEmail'])){
    $result = $db->getPassword($_POST['inpLgnEmail']);

    echo json_encode($result);
}

//header("Location: /MobileFamilyPlanner/public/myFamily.php");
