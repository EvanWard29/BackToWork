<?php include_once "../header.php";
$db = new DBConnection();
$user = $db->getUserDetails($_COOKIE['userID']);
$rewards = $db->getRewards($_COOKIE['groupID']);
$rewardRequests = $db->getRewardRequests($_COOKIE['groupID']);
$users = $db->getUsers($_COOKIE['groupID']);
?>

<html lang="en">
    <head>
        <script src="../../assets/js/rewards/rewards.js"></script>
        <link type="text/css" rel="stylesheet" href="../../assets/css/rewards.css">
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
                <h3>My Points: <span id="myPoints"></span></h3><br>
                <label for="selectedReward"><strong>Selected Reward:</strong></label>
                <label for="selectedReward" class="text-danger" style="font-size: 15px" id="rewardErr" hidden>You Do Not Have Enough Points For That! Select A Different Reward.</label>
                <input id="selectedReward" class="form-control" type="text" placeholder="Select A Reward" readonly/>

                <label id="selectedRewardID" hidden></label>
                <label id="selectedRewardPoints" hidden></label>

                <button type="button" class="btn btn-primary btn-block btnTop" id="btnRedeemReward" disabled>Redeem</button>
                <?php
                if($_COOKIE['accountType'] == 0){?>
                    <button class="btn btn-block btnTop btn-primary" id="btnRewardRequests">Reward Requests</button>
                    <button class="btn btn-block btnTop btn-primary" id="btnNewReward">New Reward</button>
                    <?php
                }
                ?>
            </div>
        </div>

        <!-- Modal Reward Requests -->
        <div class="modal fade" id="modalRewardRequests" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reward Requests</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        if($rewardRequests != null){?>
                            <table class="table-bordered" id="requests">
                                <thead>
                                    <tr><th>User Name</th><th>User Points</th><th>Reward Name</th><th>Reward Cost</th><th>Action</th></tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach($rewardRequests as $request){
                                        $requestID = $request->getRequestID();
                                        $userName = null;
                                        $userPoints = null;
                                        $rewardName = null;
                                        $rewardPoints = null;
                                        foreach($users as $user){
                                            if($user->getUserID() == $request->getUserID()){
                                                $userName = $user->getFirstName();
                                                $userPoints = $user->getPoints();
                                            }
                                        }

                                        foreach($rewards as $reward){
                                            if($reward->getRewardID() == $request->getRewardID()){
                                                $rewardName = $reward->getRewardName();
                                                $rewardPoints = $reward->getPoints();
                                            }
                                        }
                                        ?>
                                        <tr id="request<?php echo $requestID ?>">
                                            <td class="card-body table-light"><?php echo $userName ?></td>
                                            <td class="card-body table-light"><?php echo $userPoints ?></td>
                                            <td class="card-body table-light"><?php echo $rewardName ?></td>
                                            <td class="card-body table-light"><?php echo $rewardPoints ?></td>
                                            <td class="card-body table-light">
                                                <button class="btn btn-block btn-primary">APPROVE</button>
                                                <button class="btn btn-block btn-primary">DECLINE</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                        }else{?>
                            <label id="noRequests">There Are No Reward Requests.</label>
                        <?php
                        }
                        ?>
                                </tbody>
                            </table>
                        <label id="noRequests" hidden>There Are No Reward Requests.</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal New Reward -->
        <div class="modal fade" id="modalNewReward" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Reward</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="inpRewardName">Reward Name:</label>
                                <label id="rewardNameErr" class="text-danger" hidden>Reward Name Cannot Be Empty!</label>
                                <input class="form-control" id="inpRewardName"/>
                            </div>
                            <div class="form-group">
                                <label for="inpPointsCost">Points Cost:</label>
                                <label id="pointsCostErr" class="text-danger" hidden>Points Cost Cannot Be Empty And Must Be A Number!</label>
                                <input class="form-control" id="inpPointsCost"/>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnAddReward" type="button" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
include_once "../footer.php";
