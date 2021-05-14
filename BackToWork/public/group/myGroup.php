<?php include_once "../header.php"; $db = new DBConnection();?>

<html>
    <head>
        <script src="../../assets/js/account/registration/registration.js"></script>
        <script src="../../assets/js/group/selectUser.js"></script>
        <script src="../../assets/js/group/deleteMember.js"></script>
        <script src="../../assets/js/group/updateUser.js"></script>
    </head>
    <body>
        <div class="container-fluid main">
            <h1><?php echo $db->getGroupName($_COOKIE['groupID']) ?></h1>
            <div id="myGroup-content" class="container containerBackground">
                <!-- Table For Viewing Group Members -->
                <table id="family" class="table-bordered" style="height: 60%">
                    <thead>
                        <tr><th>Name</th><th>Chores Completed</th><th>Points</th></tr>
                    </thead>
                    <tbody>
                    <?php
                        $members = $db->getUsers($_COOKIE['groupID']);
                        foreach($members as $member){
                            $userID = $member->getUserID();
                            $name = $member->getFirstName();
                            if($userID == $_COOKIE['userID']){
                                $points = $_COOKIE['points'];
                            }else{
                                $points = $member->getPoints();
                            }
                            $choresCompleted = $member->getChoresCompleted();
                            ?>
                            <tr>
                                <td class='table-light names' id="user<?php echo $userID ?>"> <?php echo $name; ?> </td>
                                <td class='table-light choresCompleted'><?php echo $choresCompleted; ?></td>
                                <td class='table-light points'> <?php echo $points; ?> </td>
                            </tr>

                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            if($_COOKIE['accountType'] == 0){?>
                <div class="container">
                    <button id="btnNewMember" type="button" class="btn btn-primary btn-block btnTop">Register New Group Member</button>
                </div>
                <?php
            }  ?>
        </div>

        <?php
            //Admin Option
            if($_COOKIE['accountType'] == 0){
                include "modalAddMember.php";
            }
        ?>

        <?php include "modalViewMember.php" ?>

        <?php
            //Admin Option
            if($_COOKIE['accountType'] == 0){
                include "modalConfirmDelete.php";
            }
        ?>
    </body>
</html>

<?php
include_once "../footer.php";