<?php
    $pastRewards = $db->getPastRewards($_COOKIE['groupID'], $_COOKIE['userID']);
    $rewards = $db->getRewards($_COOKIE['groupID']);
?>

<!-- Modal Past Rewards -->
<div class="modal fade" id="modalPastRewards" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Past Rewards</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if($pastRewards != null){ ?>
                    <table class="table-bordered">
                        <thead>
                        <tr><th>Reward</th><th>Date</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($pastRewards as $pastReward){
                            $chosenReward = null;
                            foreach($rewards as $reward){
                                if($reward->getRewardID() === $pastReward->getRewardID()){
                                    $chosenReward = $reward;
                                    break;
                                }
                            }
                            ?>
                            <tr><td><?php echo $chosenReward->getRewardName() ?></td><td><?php echo $pastReward->getDate() ?></td><td><?php echo $pastReward->getStatus() ?></td></tr>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                    <?php
                }else{
                    ?>
                    <h5 class="text-center">You Haven't Redeemed Any Rewards Yet!</h5>
                    <?php
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>