<?php include_once "../header.php";
$db = new DBConnection();
$user = $db->getUserDetails($_COOKIE['userID']);
setcookie('points', $user->getPoints(), 0, "/");
$rewards = $db->getRewards($_COOKIE['groupID']);
$rewardRequests = $db->getRewardRequests($_COOKIE['groupID']);
$users = $db->getUsers($_COOKIE['groupID']);
?>

<html lang="en">
    <head>
        <link type="text/css" rel="stylesheet" href="../../assets/css/rewards.css">

        <!-- JS Code -->
        <script src="../../assets/js/rewards/rewards.js"></script>
        <script src="../../assets/js/rewards/rewardRequests.js"></script>
        <script src="../../assets/js/rewards/redeemReward.js"></script>
        <script src="../../assets/js/rewards/newReward.js"></script>
        <script src="../../assets/js/rewards/editReward.js"></script>
    </head>
    <body>
        <div class="container-fluid main">
            <h1>Rewards</h1>
            <div class="container text-left containerBackground details">
                <?php if($rewards != null){ ?>
                <table class="table-bordered">
                    <thead>
                    <tr><th>Reward</th><th>Points</th></tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($rewards as $reward){
                        ?>
                        <tr id="reward<?php echo $reward->getRewardID() ?>">
                            <td class="card-body table-light rewardName"><?php echo $reward->getRewardName() ?></td>
                            <td class="card-body table-light rewardPoints"><?php echo $reward->getPoints() ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                }else{?>
                    <h5 class="text-center"><strong>No Rewards Currently Available</strong></h5>
                <?php
                }
                ?>
            </div>
            <div class="container containerBackground" id="containerRewardSelect">
                <h3>My Points: <span><?php echo $user->getPoints() ?></span></h3><br>
                <label for="selectedReward"><strong>Selected Reward:</strong></label>
                <label for="selectedReward" class="text-danger" style="font-size: 15px" id="rewardErr" hidden>You Do Not Have Enough Points For That! Select A Different Reward.</label>
                <input id="selectedReward" class="form-control" type="text" placeholder="Select A Reward" readonly/>

                <label id="selectedRewardID" hidden></label>
                <label id="selectedRewardPoints" hidden></label>

                <button type="button" class="btn btn-primary btn-block btnTop" id="btnRedeemReward" disabled>Redeem</button>
            </div>
            <?php
            if($_COOKIE['accountType'] == 0){?>
                <div class="container containerBackground" style="margin-bottom: 15px">
                    <h3>Admin Options</h3>
                    <!-- Admin Options -->
                    <button class="btn btn-primary btn-block btnTop" id="btnEditReward" disabled>Edit Reward</button>
                    <button class="btn btn-block btnTop btn-primary" id="btnRewardRequests">Reward Requests</button>
                    <button class="btn btn-block btnTop btn-primary" id="btnNewReward">New Reward</button>
                    <button class="btn btn-block btnTop btn-danger" id="btnDeleteReward" disabled>Delete Reward</button>
                </div>
                <?php
            }
            ?>
        </div>

        <?php
            //Admin Options
            if($_COOKIE['accountType'] == 0){
                include "modalRewardRequests.php";
                include "modalNewReward.php";
                include "modalEditReward.php";
            }
        ?>
    </body>
</html>

<?php
include_once "../footer.php";
