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
                <!-- Form For Adding New Reward -->
                <form>
                    <div class="form-group">
                        <label for="inpRewardName">Reward Name:</label>
                        <label id="rewardNameErr" class="text-danger" hidden>Reward Name Cannot Be Empty And Longer Than 45 Characters!</label>
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