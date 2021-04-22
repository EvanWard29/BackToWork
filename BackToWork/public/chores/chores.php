<?php
    include_once "../header.php";

    $db = new DBConnection();
    $data = $db->getAllChores($_COOKIE['groupID']);
    $users = $db->getUsers($_COOKIE['groupID']);
    $assignedChores = $db->getAssignedChores($_COOKIE['groupID']);
?>
<html>
    <head>
        <script src="../../assets/js/chores/newChore.js"></script>
        <script src="../../assets/js/chores/selectChore.js"></script>
        <script src="../../assets/js/chores/editChore.js"></script>
        <script src="../../assets/js/chores/assignChore.js"></script>
        <script src="../../assets/js/chores/deleteChore.js"></script>
        <script src="../../assets/js/chores/completeChore.js"></script>

        <link rel="stylesheet" type="text/css" href="../../assets/css/chores.css">
    </head>
    <body>
        <div class="container-fluid main">
            <h1>Chores</h1>
            <div class="container containerBackground">
                <div class="row">
                    <?php

                    //Admin Option
                    if($_COOKIE['accountType'] ==0){
                        include "availableChores.php";
                    }

                    //Admin Option
                    if($_COOKIE['accountType'] == 0){
                        include "assignedChores.php";
                    }?>

                    <?php include "myChores.php" ?>

                </div>
            </div>
            <?php if($_COOKIE['accountType'] == 0){
                ?>
                    <!-- Admin Option New Chore -->
                    <div class="container newChoreArea">
                        <button id="btnNewChore" class="btn btn-primary btn-block btnTop" data-toggle="modal" data-target="#modalNewChore">New Chore</button>
                    </div>
                <?php
            } ?>

            <?php include "modalEditChore.php" ?>

            <?php include "modalAssignedChore.php" ?>

            <?php
                if($_COOKIE['accountType'] == 0){
                    include "modalNewChore.php";
                }
            ?>

        </div>
    </body>
</html>

<?php
include_once "../footer.php";