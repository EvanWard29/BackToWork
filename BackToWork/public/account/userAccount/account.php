<?php include_once "../../header.php";
    $db = new DBConnection();
    $user = $db->getUserDetails($_COOKIE['userID']);
?>
<html lang="en">
    <body>
        <div class="container-fluid main">
            <h1>My Account</h1>
            <!-- User Details -->
            <div class="container text-left containerBackground details">
                <h3>My Details</h3>
                <div class="row">
                    <div class="col">
                        <p>Name: <strong><span id="userName"><?php echo $user->getFirstName() . " " . $user->getLastName() ?></span></strong></p>
                    </div>
                    <div class="col">
                        <p>Email: <strong><span id="userEmail"><?php echo $user->getEmail() ?></span></strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>DOB: <strong><span id="userDOB"><?php echo $user->getDOB() ?></span></strong></p>
                    </div>
                    <div class="col">
                        <p>Group Name: <strong><span id="userGroup"><?php echo $db->getGroupname($_COOKIE['groupID'])?></span></strong></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p>Points: <strong><span id="userPoints"><?php echo $user->getPoints() ?></span></strong></p>
                    </div>
                </div>
            </div>
            <!-- User Options -->
            <div class="container containerBackground options">
                <h3>Options</h3>
                <button type="button" id="btnChangeEmail" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalChangeEmail">Change Email</button>
                <button type="button" id="btnChangePassword" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalChangePassword">Change Password</button>
                <button type="button" id="btnPastRewards" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalPastRewards">View Past Reward Claims</button>
                <?php if($_COOKIE['accountType'] == 0){ ?>
                    <button type="button" id="btnDeleteGroup" class="btn btn-danger btn-block">Disband Group</button>
                <?php
                }
                ?>
            </div>
        </div>

        <?php include "modalChangeEmail.php" ?>

        <?php include "modalChangePassword.php" ?>

        <?php include "modalPastRewards.php" ?>

        <?php include "modalDisbandGroup.php" ?>
    </body>
</html>

<?php
include_once "../../footer.php";