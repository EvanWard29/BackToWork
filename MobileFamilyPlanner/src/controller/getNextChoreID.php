<?php

include_once '../model/DBConnection.php';

$db = new DBConnection();

$choreID = $db->getNextChoreID();

echo $choreID;