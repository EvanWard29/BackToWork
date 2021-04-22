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
                <!-- Table For Showing Reward Requests -->
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